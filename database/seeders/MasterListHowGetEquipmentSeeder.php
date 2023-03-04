<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListHowGetEquipment;

class MasterListHowGetEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $how_get_equipments = [
            [
              'name' => 'Online',
            ],
            [
              'name' => 'Pengrajin Lokal',
            ],
            [
              'name' => 'Membuat Sendiri',
            ],
            [
              'name' => 'Membeli di Pasar/Toko',
            ]
        ];

        MasterListHowGetEquipment::insert($how_get_equipments);
    }
}
