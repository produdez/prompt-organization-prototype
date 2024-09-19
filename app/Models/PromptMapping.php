<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromptMapping extends Model
{
    use HasFactory;

    // public function buildSortQuery()
    // {
    //     return static::query()->where('chat_bot_id', $this->chat_bot_id);
    // }
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
