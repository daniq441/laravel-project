<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('order_id')->primary();
            $table->unsignedBigInteger('orderuser_id');
            $table->float('orderAmount');
            $table->string('orderShipName', 100);
            $table->string('orderShipAddress', 100);
            $table->string('orderCity', 50);
            $table->string('orderState', 50);
            $table->string('orderZip', 20);
            $table->string('orderCountry', 50);
            $table->string('orderPhone', 20);
            $table->string('orderEmail', 100);
            $table->timestamp('orderDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('orderStatus', ['Processing', 'Ready to ship', 'Shipped', 'Delivered']);
            $table->string('orderTrackingNumber', 80)->nullable();
            $table->foreign('orderuser_id')->references('user_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
