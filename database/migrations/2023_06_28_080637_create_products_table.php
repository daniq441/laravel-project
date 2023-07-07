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
            $table->integer('productSKU');
            $table->string('productName');
            $table->float('productPrice');
            $table->float('productWeight');
            $table->text('productCartDesc');
            $table->longText('productLongDesc');
            $table->integer('productStock');
            $table->string('productImage')->nullable();
            $table->boolean('archive')->default(0);
            $table->timestamps();
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
