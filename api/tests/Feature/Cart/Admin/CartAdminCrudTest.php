<?php

namespace Tests\Feature\Cart\Admin;

use App\Enums\CartStatus;
use App\Features\Cart\Admin\Controllers\DeleteCartController;
use App\Features\Cart\Admin\Controllers\ListCartController;
use App\Features\Cart\Admin\Controllers\ShowCartController;
use App\Features\Cart\Admin\Controllers\StoreCartController;
use App\Features\Cart\Admin\Controllers\UpdateCartController;
use App\Features\Cart\Models\Cart;
use App\Features\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CartAdminCrudTest extends TestCase{
  use RefreshDatabase;

  protected function setUp(): void{
    parent::setUp();

    Route::prefix('admin/cart')->group(function (): void{
      Route::get('/list', ListCartController::class);
      Route::post('/store', StoreCartController::class);
      Route::get('/{id}', ShowCartController::class);
      Route::patch('/{id}/update', UpdateCartController::class);
      Route::delete('/{id}/delete', DeleteCartController::class);
    });
  }

  public function test_list_filters_carts_and_returns_meta_with_product_count(): void{
    $product = $this->createProduct();
    $matching = $this->createCart([
      'name' => 'Ada Lovelace',
      'email' => 'ada@example.test',
      'status' => CartStatus::PENDING,
    ]);
    $matching->products()->create($this->lineItem($product));
    $this->createCart([
      'name' => 'Grace Hopper',
      'email' => 'grace@example.test',
      'status' => CartStatus::COMPLETE,
    ]);

    $this->getJson('/admin/cart/list?status=pending&email=ada&name=love&created_from='.now()->toDateString().'&created_to='.now()->toDateString())
      ->assertOk()
      ->assertJsonCount(1, 'data')
      ->assertJsonPath('data.0.id', $matching->id)
      ->assertJsonPath('data.0.product_count', 1)
      ->assertJsonPath('meta.per_page', 50)
      ->assertJsonPath('meta.total', 1);
  }

  public function test_store_creates_cart_and_line_item_snapshots(): void{
    $product = $this->createProduct();

    $response = $this->postJson('/admin/cart/store', $this->validPayload($product, [
      'payment_token' => 'secret-gateway-token',
    ]));

    $response->assertCreated()
      ->assertJsonPath('name', 'Ada Lovelace')
      ->assertJsonPath('status', CartStatus::PENDING->value)
      ->assertJsonPath('products.0.product_id', $product->id)
      ->assertJsonMissingPath('payment_token');

    $cartId = $response->json('id');
    $this->assertDatabaseHas('cart', ['id' => $cartId, 'payment_token' => 'secret-gateway-token']);
    $this->assertDatabaseHas('cart_products', [
      'cart_id' => $cartId,
      'product_id' => $product->id,
      'title' => 'Snapshot Product',
      'quantity' => 2,
    ]);
  }

  public function test_show_returns_aggregate_without_payment_token_and_missing_is_rejected(): void{
    $product = $this->createProduct();
    $cart = $this->createCart(['payment_token' => 'never-expose-me']);
    $cart->products()->create($this->lineItem($product));

    $this->getJson('/admin/cart/'.$cart->id)
      ->assertOk()
      ->assertJsonPath('id', $cart->id)
      ->assertJsonPath('payment_method', 'card')
      ->assertJsonPath('payment_status', 'authorized')
      ->assertJsonPath('products.0.title', 'Snapshot Product')
      ->assertJsonMissingPath('payment_token');

    $this->getJson('/admin/cart/999999')->assertUnprocessable();
  }

  public function test_patch_updates_cart_and_replace_syncs_products(): void{
    $firstProduct = $this->createProduct();
    $secondProduct = $this->createProduct();
    $cart = $this->createCart(['cart_token' => 'existing-cart-token', 'token' => 'existing-token']);
    $oldLine = $cart->products()->create($this->lineItem($firstProduct));

    $this->patchJson('/admin/cart/'.$cart->id.'/update', [
      'name' => 'Updated Customer',
      'cart_token' => 'existing-cart-token',
      'token' => 'existing-token',
      'status' => CartStatus::SHIPPED->value,
      'products' => [$this->lineItem($secondProduct, ['title' => 'Replacement Snapshot'])],
    ])
      ->assertOk()
      ->assertJsonPath('name', 'Updated Customer')
      ->assertJsonPath('products.0.product_id', $secondProduct->id)
      ->assertJsonCount(1, 'products');

    $this->assertDatabaseMissing('cart_products', ['id' => $oldLine->id]);
    $this->assertDatabaseHas('cart_products', [
      'cart_id' => $cart->id,
      'product_id' => $secondProduct->id,
      'title' => 'Replacement Snapshot',
    ]);
  }

  public function test_delete_removes_only_cart_aggregate_rows(): void{
    $product = $this->createProduct();
    DB::table('cart_status')->insert([
      'keyword' => CartStatus::PENDING->value,
      'title' => 'Pending',
      'color' => '#fff',
    ]);
    $cart = $this->createCart();
    $cart->products()->create($this->lineItem($product));

    $this->deleteJson('/admin/cart/'.$cart->id.'/delete')->assertNoContent();

    $this->assertDatabaseMissing('cart', ['id' => $cart->id]);
    $this->assertDatabaseMissing('cart_products', ['cart_id' => $cart->id]);
    $this->assertDatabaseHas('product', ['id' => $product->id]);
    $this->assertDatabaseHas('cart_status', ['keyword' => CartStatus::PENDING->value]);
  }

  public function test_store_and_patch_validation_enforce_aggregate_rules_and_uniqueness(): void{
    $product = $this->createProduct();
    $cart = $this->createCart(['cart_token' => 'duplicate-cart-token', 'token' => 'duplicate-token']);

    $invalid = $this->validPayload($product, [
      'user_id' => 999999,
      'cart_token' => 'duplicate-cart-token',
      'token' => 'duplicate-token',
      'status' => 'invalid-status',
      'products' => [[
        'product_id' => 999999,
        'quantity' => 0,
      ]],
    ]);

    $this->postJson('/admin/cart/store', $invalid)
      ->assertUnprocessable()
      ->assertJsonValidationErrors([
        'user_id',
        'cart_token',
        'token',
        'status',
        'products.0.product_id',
        'products.0.title',
        'products.0.quantity',
        'products.0.image',
        'products.0.price',
        'products.0.discount',
        'products.0.total',
      ]);

    $other = $this->createCart(['cart_token' => 'other-cart-token', 'token' => 'other-token']);

    $this->patchJson('/admin/cart/'.$cart->id.'/update', [
      'cart_token' => $other->cart_token,
      'token' => $other->token,
    ])
      ->assertUnprocessable()
      ->assertJsonValidationErrors(['cart_token', 'token']);
  }

  private function createCart(array $overrides = []): Cart{
    static $sequence = 0;
    $sequence++;

    return Cart::query()->create(array_replace([
      'user_id' => null,
      'cart_token' => 'cart-token-'.$sequence,
      'voucher_code' => null,
      'active_cart' => 1,
      'token' => 'token-'.$sequence,
      'name' => 'Customer '.$sequence,
      'email' => 'customer'.$sequence.'@example.test',
      'additional_details' => null,
      'phone' => '+10000000000',
      'city' => 'London',
      'address' => '1 Example Street',
      'company' => 'Example Ltd',
      'payment_method' => 'card',
      'payment_status' => 'authorized',
      'payment_token' => null,
      'additional_charges' => null,
      'additional_charges_total' => 3.50,
      'weight_price' => 2.25,
      'delivery_method' => 'courier',
      'external_delivery_method' => null,
      'delivery_price' => 5.00,
      'tracking_number' => null,
      'status' => CartStatus::PENDING,
    ], $overrides));
  }

  private function createProduct(): Product{
    static $sequence = 0;
    $sequence++;

    return Product::query()->create([
      'price' => 20,
      'discount' => 1,
      'wholesale' => 10,
      'model' => 'CART-PRODUCT-'.$sequence,
      'barcode' => 'CART-BARCODE-'.$sequence,
      'weight' => 1,
      'quantity' => 10,
      'out_of_stock_status' => 0,
      'status' => 'enabled',
      'url' => 'cart-product-'.$sequence,
      'sort_order' => $sequence,
    ]);
  }

  private function validPayload(Product $product, array $overrides = []): array{
    return array_replace([
      'cart_token' => 'new-cart-token',
      'active_cart' => 1,
      'token' => 'new-order-token',
      'name' => 'Ada Lovelace',
      'email' => 'ada@example.test',
      'phone' => '+441234567890',
      'city' => 'London',
      'address' => '10 Computing Lane',
      'company' => 'Analytical Engines',
      'payment_method' => 'card',
      'payment_status' => 'authorized',
      'additional_charges_total' => 3.50,
      'weight_price' => 2.25,
      'delivery_method' => 'courier',
      'delivery_price' => 5.00,
      'status' => CartStatus::PENDING->value,
      'products' => [$this->lineItem($product)],
    ], $overrides);
  }

  private function lineItem(Product $product, array $overrides = []): array{
    return array_replace([
      'product_id' => $product->id,
      'title' => 'Snapshot Product',
      'quantity' => 2,
      'image' => 'products/snapshot.jpg',
      'weight' => 1.25,
      'price' => 20.00,
      'option_price_total' => 2.00,
      'options' => '{"size":"large"}',
      'options_ids' => '1,2',
      'discount' => 1.00,
      'total' => 41.00,
    ], $overrides);
  }
}
