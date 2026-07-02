<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name')->unique();
            $table->string('industry')->nullable();
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->json('service_areas')->nullable();
            $table->text('description')->nullable();
            $table->json('services')->nullable();
            $table->json('tags')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->unsignedInteger('jobs_completed')->default(0);
            $table->string('response_time')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('cover_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_profiles');
    }
};
