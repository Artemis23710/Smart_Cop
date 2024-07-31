<?php

namespace Database\Seeders;

use App\Models\OfficerRank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliceOfficerRank extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            'Inspector General Of Police (IGP)',
            'Senior Deputy Inspector General Of Police (SDIG)',
            'Deputy Inspector General Of Police (DIG)',
            'Senior Superintendent Of Police (SSP)',
            'Superintendent Of Police (SP)',
            'Assistant Superintendent Of Police (ASP)',
            'Chief Inspector Of Police (CIP)',
            'Inspector Of Police (IP)',
            'Sub Inspector Of Police (SI)',
            'Sergeant Major (SM)',
            'Police Sergeant Class 1 (PS)',
            'Police Sergeant Class 2 (PS)',
            'Police Constable Class 1 (PC)',
            'Police Constable Class 2 (PC)',
            'Police Constable Class 3 (PC)',
            'Police Constable Class 4 (PC)',
        ];

        foreach ($ranks as $rank) {
            OfficerRank::create(['Rank_name' => $rank]);
        }
    }
}
