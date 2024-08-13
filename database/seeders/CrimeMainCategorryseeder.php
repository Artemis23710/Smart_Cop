<?php

namespace Database\Seeders;

use App\Models\Maincrimecategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrimeMainCategorryseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorys= [
            'Serious Crimes',
            'Property and Financial Crimes',
            'Violent and Public Disorder Crimes',
            'Crimes Impacting Public Safety, Governance, and Social Order'
        ];

        foreach ($categorys as $category) {
            Maincrimecategory::create(['main_crime_category' => $category]);
        }
    }
}
