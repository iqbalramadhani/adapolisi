<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListJob;

class MasterListJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
              'name' => 'Pelajar/Mahasiswa',
            ],
            [
              'name' => 'Wiraswasta',
            ],
            [
              'name' => 'Karyawan Swasta',
            ],
            [
              'name' => 'Pegawai Negeri',
            ],
            [
              'name' => 'Buruh',
            ],
            [
              'name' => 'Tidak Bekerja',
            ],
            [
              'name' => 'Petani',
            ],
            [
              'name' => 'Pemulung',
            ],
            [
              'name' => 'Pelaut',
            ],
            [
              'name' => 'Pengemudi Online',
            ],
            [
              'name' => 'Pensiunan',
            ],
            [
              'name' => 'Almarhum',
            ],
            [
              'name' => 'Ibu Rumah Tangga',
            ],
            [
              'name' => 'Asisten Rumah Tangga',
            ],
            [
              'name' => 'Juru Parkir',
            ],
            [
              'name' => 'TNI',
            ],
            [
              'name' => 'Polri',
            ]
        ];

        MasterListJob::insert($jobs);
    }
}
