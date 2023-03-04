<?php

namespace Database\Seeders;

use App\Models\MasterListPolres;
use App\Models\MasterListPolsek;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // UsersSeeder::class,
            // PermissionsSeeder::class,
            // RolesSeeder::class,
            MasterListCrimeModeSeeder::class,
            MasterListEquipmentSeeder::class,
            MasterListHowGetEquipmentSeeder::class,
            MasterListJobSeeder::class,
            MasterListMotiveSeeder::class,
            MasterListPerpetratorTargetSeeder::class,
            MasterListPotentialTargetSeeder::class,
            MasterListTimePatternSeeder::class,
            MasterListVehicleSeeder::class,
            MasterListPolres::class,
            MasterListPolsek::class,
            RoleSeeder::class,
        ]);
    }
}
