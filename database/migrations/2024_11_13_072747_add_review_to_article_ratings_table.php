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
        Schema::table('article_ratings', function (Blueprint $table) {
            //
            $table->text('review')->nullable()->after('rating_value'); // Tambahkan kolom review setelah rating_value

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_ratings', function (Blueprint $table) {
            //
            $table->dropColumn('review');
        });
    }
};
