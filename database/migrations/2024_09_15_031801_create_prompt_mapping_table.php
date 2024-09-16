<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_mapping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_bot_id')->constrained()->cascadeOnDelete();
            $table->foreignId('prompt_block_id')->constrained()->cascadeOnDelete();
            $table->integer('order_column')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompt_mapping');
    }
};
