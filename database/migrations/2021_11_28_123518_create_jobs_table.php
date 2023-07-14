<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('jop_type_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->float('salary')->nullable();
            $table->unsignedInteger('no_of_days')->nullable();
            $table->unsignedFloat('no_of_hours')->nullable();
            $table->string('last_date_to_accept')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
