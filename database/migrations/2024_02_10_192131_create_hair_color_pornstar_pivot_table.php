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
        Schema::create('hair_color_pornstar', function (Blueprint $table) {
            $table->unsignedBigInteger('pornstar_id');
            $table->foreign('pornstar_id')->references('id')->on('pornstars');
            $table->unsignedBigInteger('hair_color_id');
            $table->foreign('hair_color_id')->references('id')->on('hair_colors');
            $table->primary(['pornstar_id', 'hair_color_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hair_color_pornstar');
    }
};
