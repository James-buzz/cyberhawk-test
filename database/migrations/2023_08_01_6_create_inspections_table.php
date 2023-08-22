<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('turbine_id');
            $table->dateTime('inspected_at');
            $table->timestamps();

            $table->foreign('turbine_id')->references('id')->on('turbines')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inspections');
    }
};
