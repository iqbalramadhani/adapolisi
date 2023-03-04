<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListVehicle;

class MasterListVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = [
            [
              'name' => 'Roda 2 Sah',
            ],
            [
              'name' => 'Roda 2 Tidak Memiliki Surat Sah',
            ],
            [
              'name' => 'Roda 3 Sah',
            ],
            [
              'name' => 'Roda 3 Tidak Memiliki Surat Sah',
            ],
            [
              'name' => 'Roda 4 Sah',
            ],
            [
              'name' => 'Roda 4 Tidak Memiliki Surat Sah',
            ],
        ];

        MasterListVehicle::insert($vehicles);
    }
}
