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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pornstar_id');
            $table->foreign('pornstar_id')->references('id')->on('pornstars');
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
        Schema::dropIfExists('stats');
    }
};
