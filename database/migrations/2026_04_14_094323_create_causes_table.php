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
        Schema::create('causes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('main_action_title');
            $table->json('main_actions');
            $table->string('center_image');
            $table->json('center_stats');
            $table->string('composition_title');
            $table->json('composition_items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('causes');
    }
};
