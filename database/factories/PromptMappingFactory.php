<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Chatbot;
use App\Models\PromptBlock;
use App\Models\PromptMapping;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromptMapping>
 */

//  TODO: change this to make it reusable somehow, this currently just needs chat and prompt block to be created first
class PromptMappingFactory extends Factory
{
    protected $model = PromptMapping::class;

    public function definition(): array
    {
        return [
            'chat_bot_id' => Chatbot::inRandomOrder()->first()->id,
            'prompt_block_id' => PromptBlock::inRandomOrder()->first()->id,
        ];
    }
}
