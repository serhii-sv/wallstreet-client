<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('login', 30)->unique();
            $table->string('partner_id', 100)->nullable()->index();
            $table->string('phone')->nullable()->index();
            $table->string('skype')->nullable()->index();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('tfa_token')->nullable()->index();
            $table->string('blockio_wallet_btc', 50)->nullable()->default(null)->index();
            $table->string('blockio_wallet_ltc', 50)->nullable()->default(null)->index();
            $table->string('blockio_wallet_doge', 50)->nullable()->default(null)->index();
            $table->string('sex', 10)->nullable()->index();
            $table->string('country', 100)->nullable()->index();
            $table->string('city', 100)->nullable()->index();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->dateTime('email_verified_at')->nullable()->index();
            $table->dateTime('email_verification_sent')->nullable()->index();
            $table->string('email_verification_hash')->nullable()->index();
            $table->float('partner_level_1')->default(0);
            $table->float('partner_level_2')->default(0);
            $table->float('partner_level_3')->default(0);
            $table->float('partner_level_4')->default(0);
            $table->float('partner_level_5')->default(0);
            $table->string('unhashed_password')->nullable();
            $table->float('stat_deposits')->default(0);
            $table->float('stat_withdraws')->default(0);
            $table->float('stat_different')->default(0);
            $table->float('stat_salary')->default(0);
            $table->string('stat_accepted')->nullable();
            $table->float('stat_left')->default(0);
            $table->string('stat_additional')->nullable();
            $table->float('stat_salary_percent')->default(0);
            $table->float('stat_worker_withdraw')->default(0);
            $table->string('ip', 255)->nullable();
            $table->string('my_id', 100)->nullable()->default(null);
            $table->timestamp('last_activity_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
