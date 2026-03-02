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
        Schema::create('ai_settings', function (Blueprint $table) {
            $table->id();
            $table->string('assistant_name')->default('Assistant');
            $table->text('system_prompt')->nullable();
            $table->text('behavior_description')->nullable(); // For internal notes or user description
            $table->decimal('temperature', 3, 2)->default(0.70); // 0.00 to 2.00
            $table->integer('max_tokens')->default(2048);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_settings');
    }
};
