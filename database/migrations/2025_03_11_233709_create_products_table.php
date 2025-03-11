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
            $table->unsignedInteger('id_rayon');
            $table->foreign('id_rayon')->references('id')->on('rayons');
            $table->string('name');
            $table->text('description');
            $table->string('marque');
            $table->decimal('unit_price',8,2);
            $table->unsignedInteger('promotion')->default(0);
            $table->boolean('is_popular')->default(false);
            $table->unsignedBigInteger('stock');
            $table->unsignedBigInteger('min_stock');
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
