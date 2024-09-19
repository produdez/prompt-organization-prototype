<?php

namespace Database\Seeders;

use App\Models\PromptBlock;
use Illuminate\Database\Seeder;

class PromptBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PromptBlock::factory()->count(20)->create();
    }
}
