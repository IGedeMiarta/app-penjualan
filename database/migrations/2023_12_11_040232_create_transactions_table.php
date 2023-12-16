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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('Invoice')->unique();
            $table->unsignedBigInteger('customer');
            $table->foreign('customer')->references('id')->on('users')->onDelete('cascade');
            $table->float('amount',10);
            $table->integer('status')->comment('1=create & wait for payment,2=payment approve,3=rejected');
            $table->string('info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};