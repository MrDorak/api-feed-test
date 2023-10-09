<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawInstagramProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('instagram_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('user_id')->unique();
            $table->string('access_token')->nullable();
            $table->nullableTimestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('instagram_profiles');
    }
}
