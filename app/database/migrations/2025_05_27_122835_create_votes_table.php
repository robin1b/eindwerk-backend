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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('gift_idea_id')
                ->constrained('gift_ideas')
                ->cascadeOnDelete();
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->unique(['event_id', 'user_id', 'gift_idea_id'], 'votes_unique_per_user');
            $table->index('event_id',       'votes_event_idx');
            $table->index('user_id',        'votes_user_idx');
            $table->index('gift_idea_id',   'votes_gift_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
