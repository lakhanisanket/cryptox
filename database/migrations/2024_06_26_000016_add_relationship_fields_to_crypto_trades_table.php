<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCryptoTradesTable extends Migration
{
    public function up()
    {
        Schema::table('crypto_trades', function (Blueprint $table) {
            $table->unsignedBigInteger('platform_accounts_id')->nullable();
            $table->foreign('platform_accounts_id', 'platform_accounts_fk_9902355')->references('id')->on('plaform_accounts');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_9902356')->references('id')->on('currencies');
            $table->unsignedBigInteger('crypto_currency_id')->nullable();
            $table->foreign('crypto_currency_id', 'crypto_currency_fk_9902358')->references('id')->on('crypto_currencies');
            $table->unsignedBigInteger('payment_mode_id')->nullable();
            $table->foreign('payment_mode_id', 'payment_mode_fk_9902361')->references('id')->on('payment_modes');
            $table->unsignedBigInteger('fiat_wallet_id')->nullable();
            $table->foreign('fiat_wallet_id', 'fiat_wallet_fk_9902362')->references('id')->on('fiat_wallets');
        });
    }
}
