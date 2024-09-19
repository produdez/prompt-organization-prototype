<?php

namespace Database\Seeders;

use App\Models\ChatBot;
use Illuminate\Database\Seeder;

class ChatBotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChatBot::factory()->count(5)->create();
    }
}
