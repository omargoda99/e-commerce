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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('product_type');
            $table->integer('count_box_inPacket');
            $table->integer('count_single_InBox');
            $table->decimal('packet_cost_price', 8, 2);
            $table->decimal('packet_sell_price', 8, 2);
            $table->decimal('box_cost_price', 8, 2);
            $table->decimal('box_sell_price', 8, 2);
            $table->decimal('single_cost_price', 8, 2);
            $table->decimal('single_sell_price', 8, 2);
            $table->integer('packet_stock');
            $table->integer('box_stock');
            $table->integer('single_stock');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
