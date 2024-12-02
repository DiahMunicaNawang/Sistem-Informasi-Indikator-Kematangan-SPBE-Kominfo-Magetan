<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pastikan tipe ENUM dihapus sebelum dibuat ulang
        DB::statement("DROP TYPE IF EXISTS approval_status_enum");
        DB::statement("DROP TYPE IF EXISTS availability_status_enum");
        
        DB::statement("CREATE TYPE approval_status_enum AS ENUM ('process', 'accepted', 'rejected')");
        DB::statement("CREATE TYPE availability_status_enum AS ENUM ('open', 'closed')");
        
        Schema::create('forum_discussions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('forum_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('discussion_created_at');
            $table->timestamp('availability_status_updated_at')->nullable();
        });
        
        // Gunakan DB::raw untuk menggunakan tipe ENUM PostgreSQL
        DB::statement('ALTER TABLE forum_discussions ADD COLUMN approval_status approval_status_enum DEFAULT \'process\'');
        DB::statement('ALTER TABLE forum_discussions ADD COLUMN availability_status availability_status_enum DEFAULT \'open\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_discussions');
        DB::statement("DROP TYPE IF EXISTS approval_status_enum");
        DB::statement("DROP TYPE IF EXISTS availability_status_enum");
    }
};
