<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $this->preparedWorldAddress();

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->integer('type')->default(2)->comment("1 => Backend, 2 => Frontend");
            $table->boolean('status')->default(1)->comment("0 => Block, 1 => Active");
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->unsignedMediumInteger('city_id')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->softDeletes();
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

    public function preparedWorldAddress()
    {
        foreach (config('custom.world_addresses') as $key => $value) {
            if (!Schema::hasTable($key)) {
                DB::unprepared(file_get_contents($value['path']));
                echo ($value['key'] . " File Dump Successfully...\n");
            } else {
                echo ($value['key'] . " Already is upto date...\n");
            }
        }
    }
}
