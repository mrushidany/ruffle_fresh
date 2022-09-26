<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('draw_type_id');
            $table->foreign('draw_type_id')->references('id')->on('draw_types');
            $table->unsignedInteger('participants');
            $table->unsignedMediumInteger('no_of_winners')->default(10);
            $table->datetime('schedule');
            $table->string('status')->default('started'); //started completed closed discarded
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
        Schema::dropIfExists('draws');
    }
}
