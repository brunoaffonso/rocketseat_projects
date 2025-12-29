<?php

namespace Tests\Feature\EmailList;

use App\Models\EmailList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the index page filters by title.
     */
    public function test_index_filters_by_title(): void
    {
        $user = User::factory()->create();
        EmailList::query()->create(['title' => 'Personal List']);
        EmailList::query()->create(['title' => 'Work List']);

        $response = $this->actingAs($user)->get(route('email-list.index', ['search' => 'Work']));

        $response->assertStatus(200);
        $response->assertSee('Work List');
        $response->assertDontSee('Personal List');
    }

    /**
     * Test that pagination is preserved when searching.
     */
    public function test_pagination_preserves_search_query(): void
    {
        $user = User::factory()->create();
        EmailList::factory()->count(20)->create(['title' => 'Searchable List']);

        $response = $this->actingAs($user)->get(route('email-list.index', ['search' => 'Searchable', 'page' => 2]));

        $response->assertStatus(200);
        $response->assertSee('Searchable List');
        // Check if the current page in response has the search query in links
        $this->assertTrue(str_contains($response->getContent(), 'search=Searchable'));
    }
}
