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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid', 100)->nullable();
            $table->integer('user_id')->nullable();
            $table->json('products')->default('[]');
            $table->float('total_amount', 10, 0)->default(0);
            $table->string('order_status', 100)->default('pending');
            $table->integer('payment_status')->default(0);
            $table->string('payment_method', 100)->nullable();
            $table->integer('refund')->default(0);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
