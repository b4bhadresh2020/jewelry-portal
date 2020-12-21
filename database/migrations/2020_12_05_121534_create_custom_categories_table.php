<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->boolean('status')->default(1)->comment("0 => Deactivate, 1 => Active");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });

        Schema::create('custom_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('custom_category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['custom_category_id', 'locale']);
            $table->foreign('custom_category_id')->references('id')->on('custom_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_category_translations');
        Schema::dropIfExists('custom_categories');
    }
}