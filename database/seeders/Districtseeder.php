<?php

namespace Database\Seeders;

use App\Models\Districts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Districtseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Districts = [
            ['province_id' => 2, 'distric_name' => 'Ampara'],
            ['province_id' => 7, 'distric_name' => 'Anuradhapura'],
            ['province_id' => 8, 'distric_name' => 'Badulla'],
            ['province_id' => 2, 'distric_name' => 'Batticaloa'],
            ['province_id' => 5, 'distric_name' => 'Colombo'],
            ['province_id' => 4, 'distric_name' => 'Galle'],
            ['province_id' => 5, 'distric_name' => 'Gampaha'],
            ['province_id' => 4, 'distric_name' => 'Hambantota'],
            ['province_id' => 3, 'distric_name' => 'Jaffna'],
            ['province_id' => 5, 'distric_name' => 'Kalutara'],
            ['province_id' => 1, 'distric_name' => 'Kandy'],
            ['province_id' => 9, 'distric_name' => 'Kegalle'],
            ['province_id' => 3, 'distric_name' => 'Kilinochchi'],
            ['province_id' => 6, 'distric_name' => 'Kurunegala'],
            ['province_id' => 3, 'distric_name' => 'Mannar'],
            ['province_id' => 1, 'distric_name' => 'Matale'],
            ['province_id' => 4, 'distric_name' => 'Matara'],
            ['province_id' => 8, 'distric_name' => 'Monaragala'],
            ['province_id' => 3, 'distric_name' => 'Mullaitivu'],
            ['province_id' => 1, 'distric_name' => 'Nuwara Eliya'],
            ['province_id' => 7, 'distric_name' => 'Polonnaruwa'],
            ['province_id' => 6, 'distric_name' => 'Puttalam'],
            ['province_id' => 9, 'distric_name' => 'Ratnapura'],
            ['province_id' => 2, 'distric_name' => 'Trincomalee'],
            ['province_id' => 3, 'distric_name' => 'Vavuniya'],
            
        ];

        foreach ($Districts as $District) {
            Districts::create([
                'province_id' => $District['province_id'],
                'distric_name' => $District['distric_name']
            ]);
        }
    }
}
