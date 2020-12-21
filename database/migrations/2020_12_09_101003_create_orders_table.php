<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });

        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('key')->nullable();
            $table->string('secret')->nullable();
            $table->string('return_url')->nullable();
            $table->boolean('status')->default(0)->comment("0 =>Active, 1 => DeActive");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_combo_id');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('discount_id')->unsigned()->nullable();
            $table->integer('billing_address_id')->unsigned();
            $table->double('total');
            $table->double('discount');
            $table->double('tax');
            $table->double('total_tax');
            $table->double('payable_amount');
            $table->integer('status_id')->default(1)->comment("Like Pending, Complete, Cancel")->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('order_statuses')->onDelete('cascade');
            $table->foreign('billing_address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->softDeletes();
        });

        Schema::create('order_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('payment_gateway_id')->unsigned();
            $table->integer('payment_id')->unsigned()->nullable();
            $table->integer('payment_status_code')->nullable();
            $table->string('payment_status')->comment("Like Pending, Success, Fail");
            $table->text('meta')->nullable();
            $table->date('payment_date');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('payment_gateway_id')->references('id')->on('payment_gateways')->onDelete('cascade');
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });

        Schema::create('product_attribute_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_product_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('sku');
            $table->integer('qty');
            $table->double('mrp');
            $table->double('sell_price');
            $table->text('meta')->nullable();
            $table->text('engraving')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->foreign('order_product_id')->references('id')->on('order_products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_history_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_attribute_history_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('sort_description')->nullable();
            $table->unique(['product_attribute_history_id', 'locale'], 'unique_foreign_id');
            $table->foreign('product_attribute_history_id', 'pah_foreign_id')->references('id')->on('product_attribute_histories');
        });

        Schema::create('product_history_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_attribute_history_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->integer('option_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('product_attribute_history_id')->references('id')->on('product_attribute_histories')->onDelete('cascade');
            $table->unique(['product_attribute_history_id', 'attribute_id', 'option_id'], 'unique_foreign_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_history_variations');
        Schema::dropIfExists('product_history_translations');
        Schema::dropIfExists('product_attribute_histories');
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('order_payments');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('payment_gateways');
        Schema::dropIfExists('order_statuses');
    }
}