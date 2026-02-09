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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('\App\Models\User')->constrained()->onDelete('cascade');
            $table->string('Name');
            $table->string('StreetAddress');
            $table->string('City');
            $table->string('State');
            $table->integer('PostalCode');
            $table->timestamps();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignIdFor('App\Models\UserAddress')->after('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
