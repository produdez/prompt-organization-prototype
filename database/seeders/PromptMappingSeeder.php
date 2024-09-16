<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PromptMapping;
use App\Models\Chatbot;
use App\Models\PromptBlock;
use Laravel\Prompts\Prompt;

class PromptMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PromptMapping::factory()
            ->count(10)
            ->create();
    }
}
