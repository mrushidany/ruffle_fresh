<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrawWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draw_winners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('draw_id');
            //$table->foreign('draw_id')->references('id')->on('draws');
            $table->unsignedBigInteger('category_id');
            //$table->foreign('category_id')->references('id')->on('categories');
            $table->string('name',240);
            $table->string('phone_number',20);
            $table->string('status',20)->default('new'); // new pass disqualified received
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
        Schema::dropIfExists('draw_winners');
    }
}
