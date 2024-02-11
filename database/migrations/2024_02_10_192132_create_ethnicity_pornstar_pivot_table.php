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
        Schema::create('ethnicity_pornstar', function (Blueprint $table) {
            $table->unsignedBigInteger('ethnicity_id');
            $table->foreign('ethnicity_id')->references('id')->on('ethnicities');
            $table->unsignedBigInteger('pornstar_id');
            $table->foreign('pornstar_id')->references('id')->on('pornstars');
            $table->primary(['pornstar_id', 'ethnicity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ethnicity_pornstar');
    }
};
