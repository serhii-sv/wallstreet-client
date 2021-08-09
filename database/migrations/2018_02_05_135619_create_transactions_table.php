<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->uuid('id')->primary();
            $table->uuid('type_id')->index();
            $table->uuid('user_id')->index();
            $table->uuid('currency_id')->index();
            $table->uuid('rate_id')->nullable()->index();
            $table->uuid('deposit_id')->nullable()->index();
            $table->uuid('wallet_id')->index();
            $table->uuid('payment_system_id')->nullable()->index();
            $table->decimal('amount', 24,12)->unsigned();
            $table->float('main_currency_amount', 24, 12)->default(0);
            $table->string('source')->nullable();
            $table->string('result')->nullable();
            $table->string('batch_id')->nullable()->index();
            $table->float('commission')->nullable();
            $table->boolean('approved')->default(false);
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
