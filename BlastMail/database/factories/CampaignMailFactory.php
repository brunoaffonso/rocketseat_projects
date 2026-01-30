<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CampaignMail>
 */
class CampaignMailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'campaign_id' => \App\Models\Campaign::factory(),
            'subscriber_id' => \App\Models\Subscriber::factory(),
            'sent_at' => fake()->dateTime,
            'clicks' => fake()->numberBetween(0, 10),
            'openings' => fake()->numberBetween(0, 10),
        ];
    }
}
