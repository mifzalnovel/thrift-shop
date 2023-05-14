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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('name')->default('name');
            $table->string('email')->default('email');
            $table->string('city')->default('city');
            $table->text('address')->default('address');
            $table->string('zip_code')->default('zip_code');
            $table->string('location')->default('location');
            $table->string('sname')->default('sname');
            $table->string('semail')->default('semail');
            $table->string('scity')->default('scity');
            $table->text('saddress')->default('saddress');
            $table->string('szip_code')->default('szip_code');
            $table->string('slocation')->default('slocation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
