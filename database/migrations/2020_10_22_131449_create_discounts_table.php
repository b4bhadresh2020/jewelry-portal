<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_type')->unsigned()->default(1)->comment("1 => Coupon, 2 => Offer");
            $table->string('coupon_code')->nullable();
            $table->integer('amount_type')->unsigned()->default(1)->comment("1 => Fixed, 2 => Percentage");
            $table->float('amount', 10, 2);
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('redeem_limit')->unsigned();
            $table->boolean('status')->default(1)->comment("1 => Active,0 => Deactivate");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->softDeletes();
        });

        Schema::create('discount_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->unique(['discount_id', 'locale']);
            $table->foreign('discount_id')->references('id')->on('discounts');
        });

        Schema::create('discount_assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_id')->unsigned();
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->integer('discount_assigns_id')->unsigned();
            $table->string('discount_assigns_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_assigns');
        Schema::dropIfExists('discount_translations');
        Schema::dropIfExists('discounts');
    }
}
