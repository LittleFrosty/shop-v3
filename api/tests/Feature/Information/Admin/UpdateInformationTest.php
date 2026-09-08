<?php

namespace Tests\Feature\Information\Admin;

use App\Features\Information\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_patch_changes_only_supplied_fields_and_can_clear_thumbnail(): void
    {
        $information = $this->createInformation();

        $this->patchJson('/admin/information/'.$information->id.'/update', [
            'title' => 'Updated Policy',
            'thumbnail' => null,
            'status' => 0,
            'agreement_at_contacts' => 1,
        ])->assertOk()
            ->assertJsonPath('id', $information->id)
            ->assertJsonPath('title', 'Updated Policy')
            ->assertJsonPath('thumbnail', null)
            ->assertJsonPath('description', 'Keep this description')
            ->assertJsonPath('status', 0)
            ->assertJsonPath('agreements_at_order', 1)
            ->assertJsonPath('agreement_at_contacts', 1)
            ->assertJsonPath('show_in_footer', 1)
            ->assertJsonPath('sort_order', 3);

        $this->assertDatabaseHas('information', [
            'id' => $information->id,
            'title' => 'Updated Policy',
            'thumbnail' => null,
            'description' => 'Keep this description',
            'status' => 0,
            'agreement_at_contacts' => 1,
        ]);
    }

    public function test_patch_validates_fields_and_missing_ids(): void
    {
        $information = $this->createInformation();

        $this->patchJson('/admin/information/'.$information->id.'/update', [
            'status' => 3,
            'agreements_at_order' => 2,
            'agreement_at_contacts' => -1,
            'show_in_footer' => 4,
            'sort_order' => -1,
        ])->assertUnprocessable()
            ->assertJsonValidationErrors([
                'status',
                'agreements_at_order',
                'agreement_at_contacts',
                'show_in_footer',
                'sort_order',
            ]);

        $this->patchJson('/admin/information/999999/update', ['title' => 'Missing'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }

    private function createInformation(): Information
    {
        return Information::query()->create([
            'title' => 'Original Policy',
            'thumbnail' => 'information/original.png',
            'description' => 'Keep this description',
            'status' => 1,
            'agreements_at_order' => 1,
            'agreement_at_contacts' => 0,
            'show_in_footer' => 1,
            'sort_order' => 3,
        ]);
    }
}
