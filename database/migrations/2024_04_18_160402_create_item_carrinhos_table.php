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
        Schema::create('item_carrinhos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('carrinho_id')->nullable(false);
            $table->bigInteger('produtos_id')->nullable(false);
            $table->string('quantidade')->nullable(false);
            $table->decimal('valor_unitario')->nullable(false);
            $table->foreign('carrinho_id')->references('carrinhos')->on('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_carrinhos');
    }
};
