<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner')->nullable();
            $table->string('mobile_banner')->nullable();
            $table->integer('position')->nullable();
            $table->string('link_url')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->softDeletes();
        });

        Schema::create('banner_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned();
            $table->string('locale')->index();
            $table->string('header')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('link_text')->nullable();
            $table->unique(['banner_id', 'locale']);
            $table->foreign('banner_id')->references('id')->on('banners');
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
        Schema::dropIfExists('banners');
    }
}
