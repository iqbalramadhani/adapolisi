<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListCrimeOfPotentialTarget;

class MasterListPotentialTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $potential_targets = [
            [
              'name' => 'Nongkrong Sampai Larut Malam',
            ],
            [
              'name' => 'Balapan',
            ],
            [
              'name' => 'Suka Berkelahi',
            ],
            [
              'name' => 'Mabuk Minuman Keras',
            ],
            [
              'name' => 'Bolos Sekolah',
            ],
            [
              'name' => 'Pelanggaran Lalu Lintas',
            ],
            [
              'name' => 'Mengambil Barang Orang Tua',
            ],
            [
              'name' => 'Nonton Video Porno',
            ],
            [
              'name' => 'Melawan Guru',
            ],
            [
              'name' => 'Merokok Dibawah Umur',
            ],
            [
              'name' => 'Geng',
            ]
        ];

        MasterListCrimeOfPotentialTarget::insert($potential_targets);
    }
}
