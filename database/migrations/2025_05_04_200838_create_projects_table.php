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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('category'); // web, branding, design, production
        $table->text('technologies'); // JSON string of technologies used
        $table->string('status'); // online, offline, template
        $table->string('thumbnail')->nullable(); // Path to the main thumbnail image
        $table->text('screenshots')->nullable(); // JSON string of screenshot paths
        $table->string('url')->nullable(); // URL if the project is online
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};