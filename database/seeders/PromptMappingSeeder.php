<?php

namespace Database\Seeders;

use App\Models\ChatBot;
use App\Models\PromptBlock;
use Illuminate\Database\Seeder;

class PromptMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bots = ChatBot::all();
        $prompts = PromptBlock::all();
        foreach ($bots as $bot) {
            $prompt_relation_count = ceil(0.2 * $prompts->count() * getRandomFloatInRange(0.5, 1.5));
            $selectedPrompts = $prompts->random($prompt_relation_count);
            foreach ($selectedPrompts as $index => $prompt) {
                $bot->promptBlocks()->attach($prompt, ['order_column' => $index + 1]);
            }
        }
    }
}
