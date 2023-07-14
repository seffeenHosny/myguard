<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSubscribeGuardPackagesMigartion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_guard_packages', function (Blueprint $table) {
            $table->float('total_price')->nullable()->after('status');
            $table->float('tax')->nullable()->after('status');
            $table->float('price')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_guard_packages', function (Blueprint $table) {
            //
        });
    }
}
