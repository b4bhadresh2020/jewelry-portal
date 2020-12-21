<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFaqAndCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(1)->comment("0 => Deactivate, 1 => Active");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->softDeletes();
        });

        Schema::create('faq_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faq_category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->unique(['faq_category_id','locale']);
            $table->foreign('faq_category_id')->references('id')->on('faq_categories');
            $table->softDeletes();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faq_category_id')->unsigned();
            $table->boolean('status')->default(1)->comment("0 => Deactivate, 1 => Active");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->foreign('faq_category_id')->references('id')->on('faq_categories');
            $table->softDeletes();
        });

        Schema::create('faq_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('faq_id')->unsigned();
            $table->string('locale')->index();
            $table->string('question')->nullable();
            $table->longText('answer')->nullable();
            $table->unique(['faq_id','locale']);
            $table->foreign('faq_id')->references('id')->on('faqs');
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
        Schema::dropIfExists('faq_translations');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('faq_category_translations');
        Schema::dropIfExists('faq_categories');
    }
}
