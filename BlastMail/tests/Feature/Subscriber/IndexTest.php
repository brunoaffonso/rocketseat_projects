<?php

namespace Tests\Feature\Subscriber;

use App\Models\EmailList;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the index page displays subscribers for an email list.
     */
    public function test_index_displays_subscribers(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();
        $subscriber = Subscriber::query()->create([
            'email_list_id' => $emailList->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->actingAs($user)->get(route('subscribers.index', $emailList));

        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertSee('john@example.com');
    }

    /**
     * Test that the index page filters subscribers by search query.
     */
    public function test_index_filters_by_search(): void
    {
        $user = User::factory()->create();
        $emailList = EmailList::factory()->create();

        Subscriber::query()->create([
            'email_list_id' => $emailList->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        Subscriber::query()->create([
            'email_list_id' => $emailList->id,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);

        $response = $this->actingAs($user)->get(route('subscribers.index', ['emailList' => $emailList, 'search' => 'John']));

        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertDontSee('Jane Smith');
    }
}
