<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterListTimePattern;

class MasterListTimePatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time_patterns = [
            [
              'name' => '00.00 - 02.00',
            ],
            [
              'name' => '02.00 - 04.00',
            ],
            [
              'name' => '04.00 - 06.00',
            ],
            [
              'name' => '06.00 - 08.00',
            ],
            [
              'name' => '08.00 - 10.00',
            ],
            [
              'name' => '10.00 - 12.00',
            ],
            [
              'name' => '12.00 - 14.00',
            ],
            [
              'name' => '14.00 - 16.00',
            ],
            [
              'name' => '16.00 - 18.00',
            ],
            [
              'name' => '18.00 - 20.00',
            ],
            [
              'name' => '20.00 - 22.00',
            ],
            [
              'name' => '22.00 - 00.00',
            ],
        ];

        MasterListTimePattern::insert($time_patterns);
    }
}
