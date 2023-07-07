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
        Schema::create('users', function (Blueprint $table) {
            // $table->increments('user_id');
            $table->unsignedBigInteger('user_id')->autoIncrement();
            $table->string('userEmail', 500);
            $table->string('usernames', 500);
            $table->string('userPassword', 500);
            $table->string('userFirstName', 50);
            $table->string('userLastName', 50);
            $table->enum('Gender', ['Male', 'Female']); 
            $table->string('userCity', 90)->nullable();
            $table->string('userState', 20)->nullable();
            $table->string('userZip', 12)->nullable();
            $table->timestamp('userRegistrationDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('userPhone', 20);
            $table->string('userCountry', 20)->nullable();
            $table->string('userAddress', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
