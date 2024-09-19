<?php

namespace Database\Seeders;

use App\Models\PromptMapping;
use Illuminate\Database\Seeder;

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
