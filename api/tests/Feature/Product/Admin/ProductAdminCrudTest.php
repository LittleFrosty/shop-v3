<?php

namespace Tests\Feature\Product\Admin;

use App\Enums\Status;
use App\Features\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductAdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_filters_products_and_returns_pagination_meta(): void
    {
        $brandId = $this->createBrand('Acme');
        $categoryId = $this->createCategory('Phones');
        $matching = $this->createProduct([
            'model' => 'PHONE-100',
            'brand_id' => $brandId,
            'status' => Status::ENABLED,
            'sort_order' => 2,
        ], 'Premium Phone', [$categoryId]);
        $this->createProduct([
            'model' => 'TABLET-200',
            'status' => Status::DISABLED,
            'sort_order' => 1,
        ], 'Budget Tablet');

        $response = $this->getJson('/admin/product/list?title=Phone&model=PHONE&status=enabled&brand_id='.$brandId);

        $response->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $matching->id)
            ->assertJsonPath('data.0.description.title', 'Premium Phone')
            ->assertJsonPath('data.0.categories.0', $categoryId)
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.per_page', 50)
            ->assertJsonPath('meta.total', 1);
    }

    public function test_store_persists_product_description_and_categories(): void
    {
        $brandId = $this->createBrand('Acme');
        $categoryIds = [$this->createCategory('Phones'), $this->createCategory('Sale')];
        $payload = $this->validPayload([
            'brand_id' => $brandId,
            'category_ids' => $categoryIds,
        ]);

        $response = $this->postJson('/admin/product/store', $payload);

        $response->assertCreated()
            ->assertJsonPath('model', 'MODEL-001')
            ->assertJsonPath('url', 'model-001')
            ->assertJsonPath('description.meta_title', null)
            ->assertJsonPath('categories', $categoryIds);

        $productId = (int) $response->json('id');
        $this->assertDatabaseHas('product', [
            'id' => $productId,
            'model' => 'MODEL-001',
            'brand_id' => $brandId,
            'url' => 'model-001',
        ]);
        $this->assertDatabaseHas('product_description', [
            'product_id' => $productId,
            'title' => 'Product One',
            'tags' => 'phone,new',
        ]);
        foreach ($categoryIds as $categoryId) {
            $this->assertDatabaseHas('product_to_category', [
                'product_id' => $productId,
                'category_id' => $categoryId,
            ]);
        }
    }

    public function test_show_returns_complete_product_and_missing_product_is_rejected(): void
    {
        $categoryId = $this->createCategory('Phones');
        $product = $this->createProduct([], 'Product One', [$categoryId]);

        $this->getJson('/admin/product/'.$product->id)
            ->assertOk()
            ->assertJsonPath('id', $product->id)
            ->assertJsonPath('url', $product->url)
            ->assertJsonPath('description.id', $product->description->id)
            ->assertJsonPath('description.product_id', $product->id)
            ->assertJsonPath('categories.0', $categoryId)
            ->assertJsonStructure(['created_at', 'updated_at']);

        $this->getJson('/admin/product/999999')
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }

    public function test_update_changes_relations_and_synchronizes_categories(): void
    {
        $oldCategoryId = $this->createCategory('Old');
        $newCategoryIds = [$this->createCategory('New'), $this->createCategory('Featured')];
        $product = $this->createProduct([], 'Old title', [$oldCategoryId]);

        $response = $this->patchJson('/admin/product/'.$product->id.'/update', [
            'model' => $product->model,
            'barcode' => $product->barcode,
            'url' => $product->url,
            'title' => 'Updated title',
            'meta_title' => null,
            'category_ids' => $newCategoryIds,
        ]);

        $response->assertOk()
            ->assertJsonPath('description.title', 'Updated title')
            ->assertJsonPath('description.meta_title', null)
            ->assertJsonPath('categories', $newCategoryIds);

        $this->assertDatabaseMissing('product_to_category', [
            'product_id' => $product->id,
            'category_id' => $oldCategoryId,
        ]);
        foreach ($newCategoryIds as $categoryId) {
            $this->assertDatabaseHas('product_to_category', [
                'product_id' => $product->id,
                'category_id' => $categoryId,
            ]);
        }
    }

    public function test_delete_removes_product_dependencies(): void
    {
        $categoryId = $this->createCategory('Phones');
        $product = $this->createProduct([], 'Product One', [$categoryId]);

        $this->deleteJson('/admin/product/'.$product->id.'/delete')->assertNoContent();

        $this->assertDatabaseMissing('product', ['id' => $product->id]);
        $this->assertDatabaseMissing('product_description', ['product_id' => $product->id]);
        $this->assertDatabaseMissing('product_to_category', ['product_id' => $product->id]);
    }

    public function test_store_and_update_validation_enforce_relations_and_uniqueness(): void
    {
        $categoryId = $this->createCategory('Phones');
        $existing = $this->createProduct([], 'Existing');

        $this->postJson('/admin/product/store', $this->validPayload([
            'model' => $existing->model,
            'barcode' => $existing->barcode,
            'url' => $existing->url,
            'brand_id' => 999999,
            'category_ids' => [$categoryId, $categoryId, 999999],
        ]))
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'model', 'barcode', 'url', 'brand_id', 'category_ids.1', 'category_ids.2',
            ]);

        $other = $this->createProduct([
            'model' => 'OTHER-MODEL',
            'barcode' => 'OTHER-BARCODE',
            'url' => 'other-url',
        ], 'Other');

        $this->patchJson('/admin/product/'.$existing->id.'/update', [
            'model' => $other->model,
            'barcode' => $other->barcode,
            'url' => $other->url,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['model', 'barcode', 'url']);
    }

    private function validPayload(array $overrides = []): array
    {
        return array_replace([
            'price' => 100.50,
            'discount' => 10,
            'wholesale' => 70,
            'model' => 'MODEL-001',
            'barcode' => 'BARCODE-001',
            'weight' => 1.25,
            'youtube' => null,
            'quantity' => 10,
            'bundle_of_models' => null,
            'out_of_stock_status' => 0,
            'brand_id' => null,
            'status' => Status::ENABLED->value,
            'url' => 'model-001',
            'sort_order' => 1,
            'title' => 'Product One',
            'description' => 'Product description',
            'meta_title' => null,
            'meta_description' => null,
            'tags' => 'phone,new',
            'category_ids' => [],
        ], $overrides);
    }

    private function createProduct(
        array $overrides = [],
        string $title = 'Product One',
        array $categoryIds = [],
    ): Product {
        static $sequence = 0;
        $sequence++;

        $product = Product::query()->create(array_replace([
            'price' => 100,
            'discount' => 10,
            'wholesale' => 70,
            'model' => 'MODEL-'.$sequence,
            'barcode' => 'BARCODE-'.$sequence,
            'weight' => 1,
            'youtube' => null,
            'quantity' => 10,
            'bundle_of_models' => null,
            'out_of_stock_status' => 0,
            'brand_id' => null,
            'status' => Status::ENABLED,
            'url' => 'product-'.$sequence,
            'sort_order' => $sequence,
        ], $overrides));

        $product->description()->create([
            'title' => $title,
            'description' => $title.' description',
            'meta_title' => $title,
            'meta_description' => $title.' meta',
            'tags' => 'test',
        ]);
        $product->categories()->createMany(
            array_map(fn (int $categoryId): array => ['category_id' => $categoryId], $categoryIds)
        );

        return $product->load(['description', 'categories']);
    }

    private function createCategory(string $title): int
    {
        return (int) DB::table('category')->insertGetId([
            'top' => false,
            'status' => Status::ENABLED->value,
            'slug' => strtolower($title),
            'views' => 0,
            'image' => null,
            'parent_id' => 0,
            'depth' => 0,
            'sort_order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function createBrand(string $title): int
    {
        return (int) DB::table('brand')->insertGetId([
            'title' => $title,
            'description' => $title.' description',
            'meta_title' => $title,
            'meta_description' => $title,
            'sort_order' => 1,
            'slug' => strtolower($title),
            'image' => 'brand.jpg',
            'status' => 1,
        ]);
    }
}
