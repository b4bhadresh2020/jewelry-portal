<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(0)->comment("0 =>Active, 1 => DeActive");
            $table->string('offer_image')->nullable();
            $table->string('link_url')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->softDeletes();
        });

        Schema::create('offer_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->string('locale')->index();
            $table->string('header')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('link_text')->nullable();
            $table->unique(['offer_id', 'locale']);
            $table->foreign('offer_id')->references('id')->on('offers');
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
        Schema::dropIfExists('offers');
    }
}
