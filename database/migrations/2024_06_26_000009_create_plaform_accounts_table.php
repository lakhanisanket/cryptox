<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaformAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('plaform_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('login_details')->nullable();
            $table->string('username')->nullable();
            $table->string('balance')->nullable();
            $table->longText('note')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
