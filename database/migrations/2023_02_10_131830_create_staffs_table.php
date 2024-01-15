<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->string('gender')->nullable();
            $table->string('mobile')->nullable();
            $table->string('2fa_code')->nullable();
            $table->integer('staff_role_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('last_login')->nullable();
            $table->string('last_ip_address')->nullable();
            $table->string('meta_data')->nullable();
            $table->tinyInteger('is_blocked')->default(0);
            $table->tinyInteger('relogin')->default(0);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
};
