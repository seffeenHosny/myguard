<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJopConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jop_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jop_type_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->text('condition_ar')->nullable();
            $table->text('condition_en')->nullable();
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
        Schema::dropIfExists('jop_conditions');
    }
}
