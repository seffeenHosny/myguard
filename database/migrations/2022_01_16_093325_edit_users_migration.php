<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUsersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('qualification');
            $table->dropColumn('experience');
            $table->enum('english' , ['poor' , 'good' , 'very_good' , 'excellent'])->nullable()->after('communication');;
            $table->enum('other_cities' , ['yes' , 'no'])->nullable()->after('communication');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('qualification');
            $table->unsignedInteger('experience');
        });
    }
}
