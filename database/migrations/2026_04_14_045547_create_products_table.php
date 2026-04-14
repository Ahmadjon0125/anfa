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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('image_path');
            $table->string('absorption_rate');
            $table->string('course_duration');
            $table->string('capsule_count');
            $table->string('primary_link')->nullable();
            $table->string('secondary_link')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
