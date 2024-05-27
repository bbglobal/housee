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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("walletId");
            $table->foreign("walletId")
                ->references('id')
                ->on('wallets')
                ->onDelete("cascade");
            $table->string("upiId")->nullable();
            $table->string("via", 15)->nullable();
            $table->string("accountNumber")->nullable();
            $table->string("accountTitle", 20)->nullable();
            $table->integer("coins");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
