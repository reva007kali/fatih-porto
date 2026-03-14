<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            $table->string('motto')->nullable()->after('description');
            $table->string('cv_file')->nullable()->after('image');
            $table->string('availability_status')->nullable()->default('Available for Work')->after('cv_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_sections', function (Blueprint $table) {
            $table->dropColumn(['motto', 'cv_file', 'availability_status']);
        });
    }
};
