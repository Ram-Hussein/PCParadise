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
            $table->string('name');
            $table->foreignIdFor('\App\Models\Category')->constrained()->onDelete('cascade');
            $table->foreignIdFor('\App\Models\User', 'seller_id')->constrained()->onDelete('cascade');
            $table->string('Brand');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('condition')->default(false);
            $table->boolean('in_stock')->default(true);
            $table->string('contact method')->nullable();
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
