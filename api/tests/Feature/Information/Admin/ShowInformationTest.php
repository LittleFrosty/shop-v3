<?php

namespace Tests\Feature\Information\Admin;

use App\Features\Information\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_returns_the_full_resource(): void
    {
        $information = $this->createInformation();

        $this->getJson('/admin/information/'.$information->id)
            ->assertOk()
            ->assertJsonPath('id', $information->id)
            ->assertJsonPath('title', $information->title)
            ->assertJsonPath('thumbnail', $information->thumbnail)
            ->assertJsonPath('description', $information->description)
            ->assertJsonPath('status', 1)
            ->assertJsonPath('agreements_at_order', 1)
            ->assertJsonPath('agreement_at_contacts', 0)
            ->assertJsonPath('show_in_footer', 1)
            ->assertJsonPath('sort_order', 2)
            ->assertJsonStructure(['created_at', 'updated_at']);
    }

    public function test_show_validates_a_missing_id(): void
    {
        $this->getJson('/admin/information/999999')
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }

    private function createInformation(): Information
    {
        return Information::query()->create([
            'title' => 'Privacy Policy',
            'thumbnail' => 'information/privacy.png',
            'description' => 'Privacy details.',
            'status' => 1,
            'agreements_at_order' => 1,
            'agreement_at_contacts' => 0,
            'show_in_footer' => 1,
            'sort_order' => 2,
        ]);
    }
}
