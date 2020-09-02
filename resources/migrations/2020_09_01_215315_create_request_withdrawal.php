<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestWithdrawal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_withdrawal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id',false);
            $table->bigInteger('rekening_id',false);
            $table->float('balance',13,2);
            $table->text('note')->nullable();
            $table->boolean('is_approve')->default(0);
            $table->boolean('is_cancel')->default(0);
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
        Schema::dropIfExists('request_withdrawal');
    }
}
