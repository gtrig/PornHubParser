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
            //simple attributes
            $table->string('name');
            $table->integer('age');
            $table->string('link');
            $table->boolean('piercings');
            $table->boolean('tattoos');
            $table->string('breast_size');
            //complex attributes
            $table->unsignedBigInteger('hair_color_id');
            $table->foreign('hair_color_id')->references('id')->on('hair_colors');
            $table->unsignedBigInteger('ethnicity_id');
            $table->foreign('ethnicity_id')->references('id')->on('ethnicities');
            $table->unsignedBigInteger('breast_type_id');
            $table->foreign('breast_type_id')->references('id')->on('breast_types');
            $table->unsignedBigInteger('orientation_id');
            $table->foreign('orientation_id')->references('id')->on('orientations');
            //stats
            $table->integer('monthlySearches');
            $table->integer('premiumVideosCount');
            $table->integer('rank');
            $table->integer('rankPremium');
            $table->integer('rankWl');
            $table->integer('subscriptions');
            $table->integer('videosCount');
            $table->integer('views');
            $table->integer('whiteLabelVideoCount');


            $table->timestamps();
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
