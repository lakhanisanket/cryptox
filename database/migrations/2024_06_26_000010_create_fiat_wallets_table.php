<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiatWalletsTable extends Migration
{
    public function up()
    {
        Schema::create('fiat_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amount')->nullable();
            $table->string('type_of_user')->nullable();
            $table->float('paid_amount', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
