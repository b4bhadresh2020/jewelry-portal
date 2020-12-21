<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->text('link');
            $table->integer('parent')->default(0);
            $table->integer('order')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });

        Schema::create('user_menu_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_menu_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->unique(['user_menu_id', 'locale']);
            $table->foreign('user_menu_id')->references('id')->on('user_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_menu_translations');
        Schema::dropIfExists('user_menus');
    }
}