<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersRemoveFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'blockio_wallet_btc')) {
            Schema::table('users', function (Blueprint $table) {
                $table->removeColumn('blockio_wallet_btc');
                $table->removeColumn('blockio_wallet_ltc');
                $table->removeColumn('blockio_wallet_doge');
                $table->removeColumn('stat_deposits');
                $table->removeColumn('stat_withdraws');
                $table->removeColumn('stat_different');
                $table->removeColumn('stat_salary');
                $table->removeColumn('stat_accepted');
                $table->removeColumn('stat_left');
                $table->removeColumn('stat_additional');
                $table->removeColumn('stat_salary_percent');
                $table->removeColumn('stat_worker_withdraw');
                $table->removeColumn('partner_level_1');
                $table->removeColumn('partner_level_2');
                $table->removeColumn('partner_level_3');
                $table->removeColumn('partner_level_4');
                $table->removeColumn('partner_level_5');
                $table->removeColumn('tfa_token');
                $table->removeColumn('longitude');
                $table->removeColumn('latitude');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
