<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned();
            $table->boolean('status')->default(1)->comment("0 => Deactivate, 1 => Active");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->foreign('attribute_id')->references('id')->on('attributes');
        });

        Schema::create('option_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('option_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['option_id','locale']);
            $table->foreign('option_id')->references('id')->on('options');
        });

        Schema::create('attribute_assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoryable_type');
            $table->integer('categoryable_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_assigns');
        Schema::dropIfExists('option_translations');
        Schema::dropIfExists('options');
    }
}
