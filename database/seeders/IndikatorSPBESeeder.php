<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndikatorSPBESeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('indikator_spbes')->insert([
            [
                'name' => 'Digital Governance',
                'explanation' => 'Governance for digital transformation in public services.',
                'rule_information' => 'Based on Presidential Regulation No. 95/2018.',
                'criteria' => 'Compliance with all digital governance frameworks.',
                'current_level' => 'Level 2 - Initial Implementation',
                'target_level' => 'Level 4 - Institutionalized',
                'related_documentation' => 'governance_docs.pdf',
                'person_in_charge' => 'John Doe',
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ],
            [
                'name' => 'Digital Services',
                'explanation' => 'Transformation of public services into digital platforms.',
                'rule_information' => 'Government initiative to provide accessible services.',
                'criteria' => 'Fully functional digital service for citizens.',
                'current_level' => 'Level 1 - Planning Stage',
                'target_level' => 'Level 5 - Optimized',
                'related_documentation' => 'service_docs.pdf',
                'person_in_charge' => 'Jane Smith',
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'inactive',
            ]
        ]);
    }
}