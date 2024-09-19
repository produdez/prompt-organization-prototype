<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromptMapping extends Model
{
    protected $table = 'prompt_mapping';

    protected $fillable = ['chat_bot_id', 'prompt_block_id', 'order_column'];

    public function chatBot()
    {
        return $this->belongsTo(ChatBot::class);
    }

    public function promptBlock()
    {
        return $this->belongsTo(PromptBlock::class);
    }
}
