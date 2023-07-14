<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSubscribeCompanyPackagesMigartion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_company_packages', function (Blueprint $table) {
            $table->float('total_price')->nullable()->after('rest_of_points');
            $table->float('tax')->nullable()->after('rest_of_points');
            $table->float('price')->nullable()->after('rest_of_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_company_packages', function (Blueprint $table) {
            //
        });
    }
}
