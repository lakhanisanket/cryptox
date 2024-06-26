<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPlaformAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('plaform_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('platform_id')->nullable();
            $table->foreign('platform_id', 'platform_fk_9902212')->references('id')->on('platforms');
        });
    }
}
