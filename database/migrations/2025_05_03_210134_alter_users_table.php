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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number');
            $table->string('address');
            $table->string('username');
            $table->text('image')->default('https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pinterest.com%2Fpin%2Ffacebook-default-profile-picture--211174975311576%2F&psig=AOvVaw0LohWOMmE-DkZ8b3w6rpAt&ust=1746392600963000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCNim8saZiI0DFQAAAAAdAAAAABAE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
