<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListCrimeOfPerpetratorTarget;

class MasterListPerpetratorTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perpetrator_targets = [
            [
              'name' => 'Curanmor',
            ],
            [
              'name' => 'Tawuran',
            ],
            [
              'name' => 'Pencurian Dengan Kekerasan',
            ],
            [
              'name' => 'Pencurian Berat',
            ],
            [
              'name' => 'Pemerasan/Pemalakan',
            ],
            [
              'name' => 'Copet',
            ],
            [
              'name' => 'Aniaya Berat',
            ],
            [
              'name' => 'Pengeroyokan',
            ],
            [
              'name' => 'Curi Kaca Spion',
            ],
            [
              'name' => 'Geng Motor',
            ],
            [
              'name' => 'Pelecehan di Bis/Angkot',
            ],
        ];

        MasterListCrimeOfPerpetratorTarget::insert($perpetrator_targets);
    }
}
