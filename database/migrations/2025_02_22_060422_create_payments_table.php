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
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('status', ['پرداخت شد', 'لغو پرداخت', 'در انتظار پرداخت']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('amount');
            $table->string('description')->nullable();
            $table->string('reference_number')->nullable();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('amount');
            $table->string('description')->nullable();
            $table->enum('payment_method', ['زرین پال']);
            $table->string('payer_mobile')->nullable();
            $table->string('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
