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
        DB::statement("DROP TYPE IF EXISTS indikator_spbe_status_enum");
        DB::statement("CREATE TYPE indikator_spbe_status_enum AS ENUM ('active', 'inactive')");

        Schema::create('indikator_spbes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('explanation');
            $table->text('rule_information');
            $table->text('criteria');
            $table->text('current_level');
            $table->text('target_level');
            $table->string('related_documentation')->nullable();
            $table->string('person_in_charge');
            $table->timestamp('date_added');
            $table->timestamp('last_updated_date');
        });


        DB::statement('ALTER TABLE indikator_spbes ADD COLUMN status indikator_spbe_status_enum DEFAULT \'active\'');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_spbes');
    }
};
