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
        Schema::create('temp_product_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('App\Models\TempProduct')->constrained()->onDelete('cascade');
            $table->foreignIdFor('App\Models\Spec')->constrained()->onDelete('cascade');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_product_specs');
    }
};
