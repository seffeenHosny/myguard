<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditJobsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreignId('work_nature_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->after('last_date_to_accept');
            $table->longText('work_nature_text')->nullable()->after('last_date_to_accept');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {

        });
    }
}
