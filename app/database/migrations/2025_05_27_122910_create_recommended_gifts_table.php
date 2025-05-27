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
        Schema::create('recommended_gifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gift_idea_id')
                ->constrained('gift_ideas')
                ->cascadeOnDelete();
            $table->string('affiliate_url');
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->unique('gift_idea_id', 'recgift_giftidea_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommended_gifts');
    }
};
