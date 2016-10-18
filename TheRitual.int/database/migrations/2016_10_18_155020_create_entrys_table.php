<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrys', function (Blueprint $table) {
            $table->increments('id');
            $table->string("code")->unique();
            $table->string("ip");
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")
                ->reference("id")
                ->on("users")
                ->onDelete("cascade");
            $table->integer("period_id")->unsigned();
            $table->foreign("period_id")
                ->reference("id")
                ->on("periods")
                ->onDelete("cascade");

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
        Schema::dropIfExists('entrys');
    }
}
