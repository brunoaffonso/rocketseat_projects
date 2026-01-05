<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\EmailList::all()->each(function (\App\Models\EmailList $list) {
            \App\Models\Subscriber::factory()
                ->count(random_int(5, 20))
                ->create(['email_list_id' => $list->id]);
        });
    }
}
