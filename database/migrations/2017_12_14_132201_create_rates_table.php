<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('currency_id')->index();
            $table->string('name')->index();
            $table->decimal('min', 24,12)->default(0)->nullable()->unsigned()->index();
            $table->decimal('max', 24,12)->default(0)->nullable()->unsigned()->index();
            $table->float('daily')->default(0)->unsigned();
            $table->float('overall')->default(0)->unsigned();
            $table->integer('duration')->default(1)->unsigned()->index();
            $table->float('payout')->default(100)->unsigned();
            $table->boolean('reinvest')->default(0)->index();
            $table->boolean('autoclose')->default(0)->index();
            $table->boolean('active')->default(0)->index();
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
        Schema::dropIfExists('rates');
    }
}
