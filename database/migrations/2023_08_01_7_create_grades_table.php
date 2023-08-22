<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('inspection_id');
            $table->unsignedBigInteger('component_id');
            $table->unsignedBigInteger('grade_type_id');
            $table->timestamps();

            $table->foreign('inspection_id')->references('id')->on('inspections')->onDelete('cascade');
            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
            $table->foreign('grade_type_id')->references('id')->on('grade_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
