<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            // I kept the ID as in the api-spec.yaml it outlines one
            // Rather than using the combination of the two unsigned big integers below
            $table->id();

            $table->unsignedBigInteger('component_type_id');
            $table->unsignedBigInteger('turbine_id');
            $table->timestamps();

            $table->foreign('component_type_id')->references('id')->on('component_types')->onDelete('cascade');
            $table->foreign('turbine_id')->references('id')->on('turbines')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('components');
    }
};
