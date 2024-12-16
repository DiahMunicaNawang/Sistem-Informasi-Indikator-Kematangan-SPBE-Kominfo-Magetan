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
        Schema::create('forum_indikator_spbe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator_id');
            $table->unsignedBigInteger('forum_id');
            $table->timestamps();

            $table->foreign('indikator_id')->references('id')->on('indikator_spbes')->onDelete('cascade');
            $table->foreign('forum_id')->references('id')->on('forum_discussions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_indikator_spbe');
    }
};
