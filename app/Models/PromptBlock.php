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
        return $this->belongsToMany(ChatBot::class, 'prompt_mapping', 'prompt_block_id', 'chat_bot_id');
    }
}
