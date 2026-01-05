<?php

namespace Database\Factories;

use App\Models\EmailList;
use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'subject' => $this->faker->sentence(),
            'email_list_id' => EmailList::factory(),
            'template_id' => EmailTemplate::factory(),
            'track_click' => $this->faker->boolean(),
            'track_open' => $this->faker->boolean(),
            'body' => $this->faker->paragraphs(3, true),
            'send_at' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
