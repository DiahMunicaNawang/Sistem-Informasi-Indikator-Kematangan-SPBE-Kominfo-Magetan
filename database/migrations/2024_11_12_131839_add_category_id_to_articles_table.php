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
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('validator_user_id');

            // Tambahkan foreign key untuk relasi ke tabel article_categories
            $table->foreign('category_id')->references('id')->on('article_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Hapus foreign key dan kolom category_id jika dibatalkan
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
