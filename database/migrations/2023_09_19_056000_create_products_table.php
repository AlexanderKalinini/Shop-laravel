<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Producer;
use App\Models\Product;
use Illuminate\Database\{Migrations\Migration, Schema\Blueprint};
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->string('slug');
            $table->string('title')->unique();
            $table->string('thumbnail')->nullable();
            $table->foreignIdFor(Brand::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Producer::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('old_price')->nullable();


            // $table->string('bread_crumbs')->nullable();
            // $table->text('characteristics')->nullable();
            // $table->text('describe')->nullable();
            // $table->text('options')->nullable();
            // $table->unsignedFloat('rating')->nullable();
            // $table->unsignedInteger('count_estimates');
            // $table->unsignedInteger('estimate')->nullable();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
    }


    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('category_product');
            Schema::dropIfExists('products');
        }
    }
};
