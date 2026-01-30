<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_is_accessible_and_returns_correct_data(): void
    {
        $user = User::factory()->create();

        $list = EmailList::factory()->create();
        Subscriber::factory()->count(10)->create(['email_list_id' => $list->id]);
        Campaign::factory()->count(3)->create(['email_list_id' => $list->id]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas('subscribersCount', 10);
        $response->assertViewHas('listsCount', 1);
        $response->assertViewHas('campaignsCount', 3);
        $response->assertViewHas('recentCampaigns');
        $response->assertViewHas('recentSubscribers');
        $response->assertViewHas('growthData');
    }
}
