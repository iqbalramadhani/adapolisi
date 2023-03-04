<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListCrimeMode;

class MasterListCrimeModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crime_modes = [
            [
              'name' => 'Mengambil paksa / dengan kekerasan',
            ],
            [
              'name' => 'Memukul',
            ],
            [
              'name' => 'Menusuk / menikam',
            ],
            [
              'name' => 'Membacok',
            ],
            [
              'name' => 'Meminta secara paksa (palak)',
            ],
            [
              'name' => 'Merusak menggunakan kunci T',
            ],
            [
              'name' => 'Tipu daya / kelabui',
            ],
            [
              'name' => 'Kunci palsu / tiruan',
            ],
            [
              'name' => 'Pura-pura menjadi mata elang / debt collector',
            ],
            [
              'name' => 'Menunjuk kendaraan korban seolah-olah menjadi pelaku kejahatan',
            ],
            [
              'name' => 'Menunjuk ban kendaraan, kemudian korban lengah pelaku mengambil barang pribadi',
            ],
            [
              'name' => 'Kekerasan yang dilalukan oleh gang / kelompok',
            ],
            [
              'name' => 'Tawuran',
            ],
            [
              'name' => 'Menabrak diri ke kendaraan korban',
            ],
            [
              'name' => 'Menabrak kendaraan dan berpura-pura menjadi korban',
            ],
            [
              'name' => 'Menebar paku di jalanan',
            ],
            [
              'name' => 'Begal',
            ],
            [
              'name' => 'Pura-pura menjadi jukir atau pak ogah',
            ],
        ];

        MasterListCrimeMode::insert($crime_modes);
    }
}
