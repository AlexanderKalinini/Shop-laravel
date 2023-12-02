<?php

use App\Models\OptionValue;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\PromoCode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;


return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('phone_number')->nullable();
            $table->string('email');
            $table->string("delivery_method");
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('payment_method');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(PromoCode::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("quantity");
            $table->timestamps();
        });

        Schema::create('option_value_order_item', function (Blueprint $table) {
            $table->id()->cascadeOnDelete();
            $table->foreignId('order_item_id')->constrained('order_items')->cascadeOnDelete();
            $table->foreignId('option_value_id')->constrained('option_values')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });
        Schema::table('option_value_order_item', function (Blueprint $table) {
            $table->dropForeign(['order_item_id']);
        });

        Schema::dropIfExists('order_items');
        Schema::dropIfExists('option_value_order_item');
        Schema::dropIfExists('orders');
    }
};
