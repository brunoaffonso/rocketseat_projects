<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Observers\CampaignObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Tests\TestCase;

class CampaignObserverTest extends TestCase
{
    /**
     * Test that the Campaign model has the CampaignObserver registered.
     */
    public function test_campaign_is_observed_by_campaign_observer(): void
    {
        $reflection = new \ReflectionClass(Campaign::class);
        $attributes = $reflection->getAttributes(ObservedBy::class);

        $this->assertNotEmpty($attributes, 'Campaign model does not have the ObservedBy attribute.');

        $observerClass = $attributes[0]->getArguments()[0];
        $this->assertEquals(CampaignObserver::class, $observerClass, 'Campaign model is not observed by CampaignObserver.');
    }
}
