<?php

namespace Database\Seeders;

use App\Models\GeneralConfig;
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
        // \App\Models\User::factory(10)->create();
        $this->call(IndoRegionSeeder::class);
        $this->call(PermissionsAndRolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(AnnouncementSeeder::class);

        GeneralConfig::create([
            'slug' => 'kepala-dinas',
            'value' => 'Nama Kepala Dinas'
        ]);

        GeneralConfig::create([
            'slug' => 'nip-kepala-dinas',
            'value' => '00000000 000000 0 000'
        ]);
    }
}
