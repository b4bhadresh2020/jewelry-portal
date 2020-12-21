<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('custom_category_id')->unsigned();
            $table->string('slug');
            $table->boolean('status')->default(1)->comment("0 => Deactivate, 1 => Active");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->foreign('custom_category_id', 'cc_id_foreign')->references('id')->on('custom_categories');
        });

        Schema::create('custom_sub_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('custom_sub_category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('content')->nullable();
            $table->unique(['custom_sub_category_id', 'locale'], 'custom_subcat_id');
            $table->foreign('custom_sub_category_id', 'csc_id_foreign')->references('id')->on('custom_sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_sub_category_translations');
        Schema::dropIfExists('custom_sub_categories');
    }
}