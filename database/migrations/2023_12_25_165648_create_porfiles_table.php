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
        Schema::create('porfiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("userId");
            $table->foreign("userId")
                ->references("id")
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger("walletId");
            $table->foreign("walletId")
                ->references("id")
                ->on('wallets')
                ->onDelete('cascade');
            $table->unsignedBigInteger("ticketId");
            $table->foreign("ticketId")
                ->references("id")
                ->on('tickets')
                ->onDelete('cascade');
            $table->unsignedBigInteger("powerId");
            $table->foreign("powerId")
                ->references("id")
                ->on('powers')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porfiles');
    }
};
