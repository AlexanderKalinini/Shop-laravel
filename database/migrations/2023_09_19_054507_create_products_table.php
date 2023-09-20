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
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->string('bread_crumbs')->nullable();
            $table->string('characteristics')->nullable();
            $table->text('describe')->nullable();
            $table->text('options')->nullable();
            $table->integer('rating')->nullable();
            $table->unsignedInteger('estimates')->nullable();
            $table->unsignedInteger('count');
            $table->unsignedFloat('price');
            $table->unsignedFloat('old_price')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('producer_id')->constrained();
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
