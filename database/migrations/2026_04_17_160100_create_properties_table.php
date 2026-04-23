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
        if (! Schema::hasTable('properties')) {
            Schema::create('properties', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('title');
                $table->text('description');
                $table->decimal('price', 14, 2);
                $table->string('type', 20);
                $table->string('category', 50);
                $table->string('address');
                $table->unsignedInteger('bedrooms')->default(0);
                $table->unsignedInteger('bathrooms')->default(0);
                $table->unsignedInteger('sqft')->default(0);
                $table->timestamps();

                $table->index('type');
                $table->index('category');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
