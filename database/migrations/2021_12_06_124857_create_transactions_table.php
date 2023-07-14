<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('guard_package_id')->nullable();
            $table->bigInteger('company_package_id')->nullable();
            $table->double('amount')->default(0.0);
            $table->enum('status', ['approved' , 'failed' , 'pending']);
            $table->enum('type', ['company' , 'guard']);
            $table->softDeletes();
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
