<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop__categories', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('分类名称');
            $table->string('img')->comment('分类图片');
            $table->integer('status')->comment('状态：1显示，0隐藏');
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
        Schema::dropIfExists('shop__categories');
    }
}
