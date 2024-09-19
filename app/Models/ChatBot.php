<?php

namespace App\Models;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBot extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = ['name', 'description'];

    public function promptBlocks()
    {

        return $this->belongsToMany(PromptBlock::class, 'prompt_mapping', 'chat_bot_id', 'prompt_block_id');
    }

    // TODO: maybe remove later
    public function chatBotPrompts()
    {
        $result = $this->hasMany(PromptMapping::class, 'chat_bot_id', 'id');
        Debugbar::info('ChatBot::chatBotPrompts() count', $result->count());

        return $result;
    }
}
