<?php

namespace Database\Seeders;

use App\Models\provinces;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Provinceseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'Central Province',
            'Eastern Province',
            'Northern Province',
            'Southern Province',
            'Western Province',
            'North Western Province',
            'North Central Province',
            'Uva Province',
            'Sabaragamuwa Province',
        ];

        foreach ($provinces as $province) {
            provinces::create(['province_name' => $province]);
        }
    }
}
