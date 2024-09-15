<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Testing\Fluent\Concerns\Has;

class ChatBot extends Model
{
    use HasFactory;
    // Define the fillable attributes
    protected $fillable = ['name', 'description'];

    /**
     * Get the prompt blocks associated with the chatbot through the prompt mappings.
     */
    public function promptBlocks()
    {
        return $this->hasManyThrough(
            PromptBlock::class,
            PromptMapping::class,
            'chat_bot_id', // Foreign key on PromptMapping table
            'id', // Foreign key on PromptBlock table
            'id', // Local key on ChatBot table
            'prompt_block_id' // Local key on PromptMapping table
        );
    }
}
