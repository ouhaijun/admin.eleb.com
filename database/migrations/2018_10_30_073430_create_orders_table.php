<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('shop_id')->comment('商家ID');
            $table->string('sn')->comment('订单编号');
            $table->string('province')->comment('省');
            $table->string('city')->comment('市');
            $table->string('county')->comment('县');
            $table->string('address')->comment('详细地址');
            $table->string('tel')->comment('收货人电话');
            $table->string('name')->comment('收货人姓名');
            $table->decimal('total')->comment('价格');
            $table->integer('status')->comment('状态');
            $table->string('out_trade_no')->comment('第三方交易号');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
