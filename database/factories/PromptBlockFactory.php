<?php

namespace Database\Factories;

use App\Models\PromptBlock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromptBlock>
 */
class PromptBlockFactory extends Factory
{
    protected $model = PromptBlock::class;

    public function definition(): array
    {
        return [
            'name' => 'Prompt: ' . $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];
    }
}
