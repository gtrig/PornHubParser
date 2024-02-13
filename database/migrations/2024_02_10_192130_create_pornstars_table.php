<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pornstars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ph_id');
            //simple attributes
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('link');
            $table->string('license');
            $table->boolean('wlStatus');
            $table->boolean('piercings');
            $table->boolean('tattoos');
            $table->string('breast_size')->nullable();
            //complex attributes
            $table->unsignedBigInteger('breast_type_id')->nullable();
            $table->foreign('breast_type_id')->references('id')->on('breast_types');
            $table->unsignedBigInteger('orientation_id')->nullable();
            $table->foreign('orientation_id')->references('id')->on('orientations');
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->timestamps();
            $table->index('name');
            $table->index('ph_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pornstars');
    }
};
