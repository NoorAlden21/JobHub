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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->foreignId('country_id')->constrained('countries');
            $table->string('password');
            $table->string('title')->nullable();
            $table->string('company_name')->nullable();
            $table->enum('company_size', ['small', 'medium', 'large'])->nullable();
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            // $table->string('logo')->nullable();
            $table->decimal('rating')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
