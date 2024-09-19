<?php

namespace Database\Factories;

use App\Models\ChatBot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatBot>
 */
class ChatBotFactory extends Factory
{
    protected $model = ChatBot::class;

    public function definition(): array
    {
        return [
            'name' => 'Bot '.$this->faker->name,
            'description' => $this->faker->jobTitle(),
        ];
    }
}
