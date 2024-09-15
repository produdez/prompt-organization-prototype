<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromptMapping extends Model
{
    use HasFactory;

    protected $fillable = ['chat_bot_id', 'prompt_block_id'];

    public function chatBot()
    {
        return $this->belongsTo(ChatBot::class);
    }

    public function promptBlock()
    {
        return $this->belongsTo(PromptBlock::class);
    }
}
