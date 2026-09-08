<?php

namespace Tests\Feature\Brand\Admin;

use App\Features\Brand\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandAdminCrudTest extends TestCase
{
    use RefreshDatabase;

    private int $brandSequence = 0;

    public function test_list_is_deterministic_and_has_pagination_shape(): void
    {
        $brands = collect(range(1, 51))->map(fn (): Brand => $this->createBrand([
            'sort_order' => 10,
        ]));

        $response = $this->getJson('/admin/brand/list');

        $response->assertOk()
            ->assertJsonCount(50, 'data')
            ->assertJsonPath('data.0.id', $brands[0]->id)
            ->assertJsonPath('data.49.id', $brands[49]->id)
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('meta.per_page', 50)
            ->assertJsonPath('meta.total', 51)
            ->assertJsonStructure([
                'data' => [[
                    'id',
                    'title',
                    'description',
                    'meta_title',
                    'meta_description',
                    'sort_order',
                    'slug',
                    'image',
                    'status',
                ]],
                'meta' => ['current_page', 'last_page', 'per_page', 'total'],
            ]);

        $this->getJson('/admin/brand/list?page=2')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $brands[50]->id);
    }

    public function test_list_filters_by_title_and_status(): void
    {
        $matching = $this->createBrand(['title' => 'Acme Tools', 'status' => 1]);
        $this->createBrand(['title' => 'Acme Archive', 'status' => 0]);
        $this->createBrand(['title' => 'Other Tools', 'status' => 1]);

        $this->getJson('/admin/brand/list?title=Acme&status=1')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $matching->id)
            ->assertJsonPath('meta.total', 1);
    }

    public function test_store_validates_and_persists_all_fields(): void
    {
        $payload = [
            'title' => 'Acme',
            'description' => 'Acme products',
            'meta_title' => 'Acme Brand',
            'meta_description' => 'Browse Acme products',
            'sort_order' => 4,
            'slug' => 'acme',
            'image' => 'brands/acme.png',
            'status' => 1,
        ];

        $this->postJson('/admin/brand/store', $payload)
            ->assertCreated()
            ->assertJsonPath('title', 'Acme')
            ->assertJsonPath('description', 'Acme products')
            ->assertJsonPath('meta_title', 'Acme Brand')
            ->assertJsonPath('meta_description', 'Browse Acme products')
            ->assertJsonPath('sort_order', 4)
            ->assertJsonPath('slug', 'acme')
            ->assertJsonPath('image', 'brands/acme.png')
            ->assertJsonPath('status', 1);

        $this->assertDatabaseHas('brand', $payload);

        $this->postJson('/admin/brand/store', $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['slug']);
    }

    public function test_store_rejects_invalid_fields(): void
    {
        $this->postJson('/admin/brand/store', [
            'title' => '',
            'description' => null,
            'meta_title' => '',
            'meta_description' => '',
            'sort_order' => -1,
            'slug' => '',
            'image' => '',
            'status' => 2,
        ])->assertUnprocessable()
            ->assertJsonValidationErrors([
                'title',
                'description',
                'meta_title',
                'meta_description',
                'sort_order',
                'slug',
                'image',
                'status',
            ]);
    }

    public function test_show_returns_brand_and_validates_missing_id(): void
    {
        $brand = $this->createBrand(['title' => 'Visible Brand']);

        $this->getJson('/admin/brand/'.$brand->id)
            ->assertOk()
            ->assertJsonPath('id', $brand->id)
            ->assertJsonPath('title', 'Visible Brand')
            ->assertJsonPath('slug', $brand->slug)
            ->assertJsonPath('status', $brand->status);

        $this->getJson('/admin/brand/999999')
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }

    public function test_patch_update_changes_only_supplied_fields_and_validates_slug(): void
    {
        $brand = $this->createBrand([
            'title' => 'Old title',
            'slug' => 'original-slug',
            'description' => 'Keep this',
        ]);
        $other = $this->createBrand(['slug' => 'reserved-slug']);

        $this->patchJson('/admin/brand/'.$brand->id.'/update', [
            'title' => 'New title',
            'status' => 0,
            'slug' => 'original-slug',
        ])->assertOk()
            ->assertJsonPath('id', $brand->id)
            ->assertJsonPath('title', 'New title')
            ->assertJsonPath('description', 'Keep this')
            ->assertJsonPath('slug', 'original-slug')
            ->assertJsonPath('status', 0);

        $this->assertDatabaseHas('brand', [
            'id' => $brand->id,
            'title' => 'New title',
            'description' => 'Keep this',
            'status' => 0,
        ]);

        $this->patchJson('/admin/brand/'.$brand->id.'/update', [
            'slug' => $other->slug,
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['slug']);

        $this->patchJson('/admin/brand/999999/update', ['title' => 'Missing'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }

    public function test_delete_hard_deletes_and_validates_missing_id(): void
    {
        $brand = $this->createBrand();

        $this->deleteJson('/admin/brand/'.$brand->id.'/delete')
            ->assertNoContent();

        $this->assertDatabaseMissing('brand', ['id' => $brand->id]);

        $this->deleteJson('/admin/brand/'.$brand->id.'/delete')
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }

    private function createBrand(array $overrides = []): Brand
    {
        $this->brandSequence++;

        return Brand::query()->create(array_merge([
            'title' => 'Brand '.$this->brandSequence,
            'description' => 'Description '.$this->brandSequence,
            'meta_title' => 'Meta title '.$this->brandSequence,
            'meta_description' => 'Meta description '.$this->brandSequence,
            'sort_order' => $this->brandSequence,
            'slug' => 'brand-'.$this->brandSequence,
            'image' => 'brands/'.$this->brandSequence.'.png',
            'status' => 1,
        ], $overrides));
    }
}
