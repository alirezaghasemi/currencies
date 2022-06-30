<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{

    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('address')->comment('آدرس کیف پول');
            $table->bigInteger('balance')->comment('میزان دارایی');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
