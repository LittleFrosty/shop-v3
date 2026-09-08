<?php

namespace Tests\Feature\Information\Admin;

use App\Features\Information\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_hard_deletes_and_validates_missing_ids(): void
    {
        $information = Information::query()->create([
            'title' => 'Delete Me',
            'thumbnail' => null,
            'description' => 'Temporary information.',
            'status' => 1,
            'agreements_at_order' => 0,
            'agreement_at_contacts' => 0,
            'show_in_footer' => 0,
            'sort_order' => 1,
        ]);

        $this->deleteJson('/admin/information/'.$information->id.'/delete')
            ->assertNoContent();

        $this->assertDatabaseMissing('information', ['id' => $information->id]);

        $this->deleteJson('/admin/information/'.$information->id.'/delete')
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }
}
