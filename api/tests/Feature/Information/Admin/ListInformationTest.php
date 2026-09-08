<?php

namespace Tests\Feature\Information\Admin;

use App\Features\Information\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListInformationTest extends TestCase
{
    use RefreshDatabase;

    private int $sequence = 0;

    public function test_list_is_ordered_and_has_pagination_metadata(): void
    {
        $items = collect(range(1, 51))->map(fn (): Information => $this->createInformation([
            'sort_order' => 10,
        ]));

        $this->getJson('/admin/information/list')
            ->assertOk()
            ->assertJsonCount(50, 'data')
            ->assertJsonPath('data.0.id', $items[0]->id)
            ->assertJsonPath('data.49.id', $items[49]->id)
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.last_page', 2)
            ->assertJsonPath('meta.per_page', 50)
            ->assertJsonPath('meta.total', 51)
            ->assertJsonStructure([
                'data' => [[
                    'id',
                    'title',
                    'thumbnail',
                    'description',
                    'status',
                    'agreements_at_order',
                    'agreement_at_contacts',
                    'show_in_footer',
                    'sort_order',
                    'created_at',
                    'updated_at',
                ]],
                'meta' => ['current_page', 'last_page', 'per_page', 'total'],
            ]);

        $this->getJson('/admin/information/list?page=2')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $items[50]->id);
    }

    public function test_list_filters_by_title_and_status(): void
    {
        $matching = $this->createInformation(['title' => 'Shipping Policy', 'status' => 1]);
        $this->createInformation(['title' => 'Shipping Archive', 'status' => 0]);
        $this->createInformation(['title' => 'Privacy Policy', 'status' => 1]);

        $this->getJson('/admin/information/list?title=Shipping&status=1')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.id', $matching->id)
            ->assertJsonPath('meta.total', 1);
    }

    private function createInformation(array $overrides = []): Information
    {
        $this->sequence++;

        return Information::query()->create(array_merge([
            'title' => 'Information '.$this->sequence,
            'thumbnail' => 'information/'.$this->sequence.'.png',
            'description' => 'Description '.$this->sequence,
            'status' => 1,
            'agreements_at_order' => 0,
            'agreement_at_contacts' => 0,
            'show_in_footer' => 1,
            'sort_order' => $this->sequence,
        ], $overrides));
    }
}
