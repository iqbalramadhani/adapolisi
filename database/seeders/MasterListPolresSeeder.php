<?php

namespace Database\Seeders;

use App\Models\MasterListPolres;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterListPolresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $polres = [
            [
              'name' => 'POLRES METRO JAKPUS'
            ],
            [
              'name' => 'POLRES METRO JAKUT'
            ],
            [
              'name' => 'POLRES METRO JAKBAR'
            ],
            [
              'name' => 'POLRES METRO JAKSEL'
            ],
            [
              'name' => 'POLRES METRO JAKTIM'
            ],
            [
              'name' => 'POLRES METRO TANGERANG KT'
            ],
            [
              'name' => 'POLRES METRO BEKASI KOTA'
            ],
            [
              'name' => 'POLRES METRO BEKASI'
            ],
            [
              'name' => 'POLRES METRO DEPOK'
            ],
            [
              'name' => 'POLRES PEL. TANJUNG PRIOK'
            ],
            [
              'name' => 'POLRES KEPULAUAN SERIBU'
            ],
            [
              'name' => 'POLRES TANGERANG SELATAN'
            ]
        ];

        MasterListPolres::insert($polres);
    }
}
