<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('turbines', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('farm_id');
            $table->double('lat');
            $table->double('lng');
            $table->timestamps();

            $table->foreign('farm_id')->references('id')->on('farms')->onDelete('cascade'); // on delete of farm delete all related turbines
        });
    }

    public function down()
    {
        Schema::dropIfExists('turbines');
    }
};
