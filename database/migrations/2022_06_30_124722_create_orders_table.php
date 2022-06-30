<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('شناسه کاربر');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('currency_id')->comment('شناسه ارز');
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->bigInteger('amount')->comment('میزان دارایی');
            $table->tinyInteger('fee')->default(0)->comment('فی');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
