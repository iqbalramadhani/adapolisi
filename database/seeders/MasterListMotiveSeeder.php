<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListMotive;

class MasterListMotiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motives = [
            [
              'name' => 'Mencari Popularitas/Legitimasi',
            ],
            [
              'name' => 'Tekanan Psikologi',
            ],
            [
              'name' => 'Ekonomi (Mencari Keuntungan)',
            ],
            [
              'name' => 'Ekonomi (Bertahan Hidup)',
            ],
            [
              'name' => 'Balas Dendam',
            ],
            [
              'name' => 'Ajakan Teman',
            ],
        ];

        MasterListMotive::insert($motives);
    }
}
