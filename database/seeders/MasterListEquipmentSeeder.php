<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListEquipment;

class MasterListEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipments = [
            [
              'name' => 'Senjata Api',
            ],
            [
              'name' => 'Senjata Tajam/Penusuk',
            ],
            [
              'name' => 'Benda Tumpul',
            ],
            [
              'name' => 'Petasan',
            ],
            [
              'name' => 'Panah',
            ],
            [
              'name' => 'Air Soft Gun',
            ],
            [
              'name' => 'Senapan Angin',
            ],
        ];

        MasterListEquipment::insert($equipments);
    }
}
