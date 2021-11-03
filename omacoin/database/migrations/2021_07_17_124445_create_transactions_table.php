<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('ref', 20);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('bank_id')->constrained()->nullable();
            $table->string('account_number', 20)->nullable();
            $table->string('account_name', 200)->nullable();
            $table->string('platform', 100);
            $table->string('currency', 10);
            $table->string('wallet_platform', 100);
            $table->string('wallet_currency', 10);
            $table->string('wallet_network', 10)->nullable();
            $table->string('wallet_address', 100);
            $table->decimal('wallet_rate', 8, 2);
            $table->decimal('crypto_amount', 8, 2);
            $table->string('crypto_receipt', 100);
            $table->decimal('naira_amount', 12, 2)->nullable();
            $table->string('naira_receipt', 100)->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'canceled']);
            $table->enum('stage', ['crypto_sent', 'crypto_received', 'naira_sent', 'naira_received']);
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
