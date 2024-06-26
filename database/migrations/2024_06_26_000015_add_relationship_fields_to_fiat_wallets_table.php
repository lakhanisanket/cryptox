<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFiatWalletsTable extends Migration
{
    public function up()
    {
        Schema::table('fiat_wallets', function (Blueprint $table) {
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_9902293')->references('id')->on('currencies');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9902296')->references('id')->on('users');
            $table->unsignedBigInteger('payment_mode_id')->nullable();
            $table->foreign('payment_mode_id', 'payment_mode_fk_9902297')->references('id')->on('payment_modes');
            $table->unsignedBigInteger('paid_currency_id')->nullable();
            $table->foreign('paid_currency_id', 'paid_currency_fk_9902298')->references('id')->on('currencies');
        });
    }
}
