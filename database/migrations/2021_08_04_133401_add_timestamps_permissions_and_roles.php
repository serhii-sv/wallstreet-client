<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsPermissionsAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('model_has_permissions', function ($table){
            $table->timestamps();
        });
        Schema::table('role_has_permissions', function ($table){
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
        Schema::dropColumns('model_has_permissions', ['created_at', 'updated_at']);
        Schema::dropColumns('role_has_permissions', ['created_at', 'updated_at']);
    }
}
