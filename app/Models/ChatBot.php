<?php

namespace App\Models;

use Barryvdh\Debugbar\Facades\Debugbar;
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
        return $this->belongsToMany(PromptBlock::class, 'prompt_mapping', 'chat_bot_id', 'prompt_block_id');
    }

    public function chatBotPrompts()
    {
        $result = $this->hasMany(PromptMapping::class, 'chat_bot_id', 'id');
        Debugbar::info('ChatBot::chatBotPrompts() count', $result->count());
        return $result;
    }
}
