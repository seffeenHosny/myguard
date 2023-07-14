<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->boolean('verify_phone')->default(0);
            $table->boolean('verify_email')->default(0);
            $table->string('code')->nullable();
            $table->enum('type' , ['super_admin' , 'admin' , 'company' , 'guard'])->nullable();
            $table->text('image')->nullable();
            $table->boolean('block')->default(0);
            $table->boolean('online_status')->default(0);
            $table->boolean('dark_mode')->default(0);
            $table->boolean('no_experience')->default(0);
            $table->boolean('military_experience')->default(0);
            $table->boolean('experience_of_the_filed_of_security')->default(0);
            $table->string('lang')->default('ar');
            $table->string('commercial_registration_no')->nullable();
            $table->text('commercial_registration_image')->nullable();
            $table->text('identification_id')->nullable();
            $table->string('iban_no')->nullable();
            $table->string('qualification')->nullable();
            $table->longText('fcm_token')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->unsignedInteger('experience')->nullable();
            $table->enum('gender' , ['male' , 'female'])->default('male');
            $table->enum('social_status' , ['single' , 'married'])->default('single');
            $table->foreignId('company_type_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('jop_type_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('offer_me')->nullable()->default(0);
            $table->unsignedInteger('appear')->nullable()->default(0);
            $table->unsignedInteger('communication')->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
