<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\CampaignMail;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignStatisticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_campaign_statistics_calculation(): void
    {
        $campaign = Campaign::factory()->create();

        // 5 sent, 3 opened, 2 clicked
        CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => Subscriber::factory()->create()->id,
            'openings' => 1,
            'clicks' => 0,
        ]);
        CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => Subscriber::factory()->create()->id,
            'openings' => 2,
            'clicks' => 1,
        ]);
        CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => Subscriber::factory()->create()->id,
            'openings' => 1,
            'clicks' => 1,
        ]);
        CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => Subscriber::factory()->create()->id,
            'openings' => 0,
            'clicks' => 0,
        ]);
        CampaignMail::create([
            'campaign_id' => $campaign->id,
            'subscriber_id' => Subscriber::factory()->create()->id,
            'openings' => 0,
            'clicks' => 0,
        ]);

        $stats = $campaign->statistics;

        $this->assertEquals(5, $stats['sent']);
        $this->assertEquals(3, $stats['opened']);
        $this->assertEquals(2, $stats['clicked']);
        $this->assertEquals(60.0, $stats['open_rate']);
        $this->assertEquals(40.0, $stats['click_rate']);
    }

    public function test_campaign_show_displays_statistics(): void
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create();

        CampaignMail::factory()->count(10)->create([
            'campaign_id' => $campaign->id,
            'openings' => 1,
        ]);

        $response = $this->actingAs($user)->get(route('campaigns.show', $campaign));

        $response->assertStatus(200);
        $response->assertViewHas('campaign');
        $response->assertViewHas('chartData');
        $response->assertSee('10'); // Total Sent
    }
}
