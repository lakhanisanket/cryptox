<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExpensesTable extends Migration
{
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_9906780')->references('id')->on('currencies');
            $table->unsignedBigInteger('by_id')->nullable();
            $table->foreign('by_id', 'by_fk_9906782')->references('id')->on('users');
        });
    }
}
