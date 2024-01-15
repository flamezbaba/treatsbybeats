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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->bigInteger('customer_id');
            $table->bigInteger('staff_id');
            $table->bigInteger('loan_package_id');
            $table->decimal('amount');
            $table->decimal('total_repayment', 10, 2);
            $table->decimal('interest', 10, 2);
            $table->string('repayment_plan');
            $table->string('week_day')->nullable();
            $table->integer('loan_duration');
            $table->string('loan_duration_type');
            $table->integer('duration_days');
            $table->integer('duration_weeks');
            $table->integer('duration_months');
            $table->decimal('daily_repayment', 10, 2)->default(0);
            $table->decimal('weekly_repayment', 10, 2)->default(0);
            $table->decimal('monthly_repayment', 10, 2)->default(0);
            $table->decimal('daily_remainder', 10, 2)->default(0);
            $table->decimal('weekly_remainder', 10, 2)->default(0);
            $table->decimal('monthly_remainder', 10, 2)->default(0);
            $table->tinyInteger('is_completed')->default(0);
            $table->tinyInteger('is_closed')->default(0);
            $table->tinyInteger('is_manager_approved')->default(0);
            $table->bigInteger('approved_by')->nullable();
            $table->bigInteger('closed_by')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->datetime('starts_at')->nullable();
            $table->datetime('ends_at')->nullable();
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
        Schema::dropIfExists('loans');
    }
};
