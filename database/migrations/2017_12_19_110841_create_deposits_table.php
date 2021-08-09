<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('currency_id')->index();
            $table->uuid('rate_id')->index();
            $table->uuid('user_id')->index();
            $table->uuid('wallet_id')->index();
            $table->float('daily')->default(0)->unsigned()->nullable();
            $table->float('overall')->default(0)->unsigned()->nullable();
            $table->integer('duration')->default(0)->unsigned()->nullable();
            $table->float('payout')->default(0)->unsigned()->nullable();
            $table->decimal('invested', 24,12)->default(0)->unsigned();
            $table->decimal('balance', 24,12)->default(0)->nullable()->unsigned();
            $table->boolean('autoclose')->default(0)->index();
            $table->boolean('active')->default(0)->index();
            $table->string('condition')->default('undefined')->index();
            $table->dateTime('datetime_closing');
            $table->timestamps();
            $table->integer('reinvest')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
