<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class PromptMapping extends Pivot  implements Sortable
{
    use HasFactory;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
        'sort_on_has_many' => true,
    ];
    public function buildSortQuery()
    {
        return static::query()->where('chat_bot_id', $this->chat_bot_id);
    }

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
