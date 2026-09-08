<?php

namespace Tests\Feature\Information\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_persists_and_returns_the_full_resource(): void
    {
        $payload = [
            'title' => 'Terms and Conditions',
            'thumbnail' => null,
            'description' => 'The complete terms.',
            'status' => 1,
            'agreements_at_order' => 1,
            'agreement_at_contacts' => 0,
            'show_in_footer' => 1,
            'sort_order' => 4,
        ];

        $this->postJson('/admin/information/store', $payload)
            ->assertCreated()
            ->assertJsonPath('title', $payload['title'])
            ->assertJsonPath('thumbnail', null)
            ->assertJsonPath('description', $payload['description'])
            ->assertJsonPath('status', 1)
            ->assertJsonPath('agreements_at_order', 1)
            ->assertJsonPath('agreement_at_contacts', 0)
            ->assertJsonPath('show_in_footer', 1)
            ->assertJsonPath('sort_order', 4)
            ->assertJsonStructure(['id', 'created_at', 'updated_at']);

        $this->assertDatabaseHas('information', $payload);
    }

    public function test_store_rejects_missing_and_invalid_fields(): void
    {
        $this->postJson('/admin/information/store', [
            'title' => '',
            'thumbnail' => str_repeat('a', 257),
            'description' => null,
            'status' => 2,
            'agreements_at_order' => -1,
            'agreement_at_contacts' => 2,
            'show_in_footer' => 3,
            'sort_order' => -1,
        ])->assertUnprocessable()
            ->assertJsonValidationErrors([
                'title',
                'thumbnail',
                'description',
                'status',
                'agreements_at_order',
                'agreement_at_contacts',
                'show_in_footer',
                'sort_order',
            ]);

        $this->postJson('/admin/information/store', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'title',
                'description',
                'status',
                'agreements_at_order',
                'agreement_at_contacts',
                'show_in_footer',
                'sort_order',
            ]);
    }
}
