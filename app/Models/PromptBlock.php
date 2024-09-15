<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromptBlock extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content'];

    public function chatBots()
    {
        return $this->hasManyThrough(
            ChatBot::class,
            PromptMapping::class,
            'prompt_block_id', // Foreign key on PromptMapping table
            'id', // Foreign key on PromptBlock table
            'id', // Local key on ChatBot table
            'chat_bot_id' // Local key on PromptMapping table
        );
    }
}
