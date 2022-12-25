<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->assignRole('Superadmin');
        User::find(2)->assignRole('Puskesmas');
        User::find(3)->assignRole('Puskesmas');
        User::find(4)->assignRole('Puskesmas');
        User::find(5)->assignRole('Puskesmas');
        User::find(6)->assignRole('Puskesmas');
        User::find(7)->assignRole('Puskesmas');
        User::find(8)->assignRole('Puskesmas');
        User::find(9)->assignRole('Puskesmas');
        User::find(10)->assignRole('Puskesmas');
        User::find(11)->assignRole('Puskesmas');
        User::find(12)->assignRole('Puskesmas');
        User::find(13)->assignRole('Puskesmas');
        User::find(14)->assignRole('Puskesmas');
        User::find(15)->assignRole('Puskesmas');
        User::find(16)->assignRole('Puskesmas');
        User::find(17)->assignRole('Puskesmas');
        User::find(19)->assignRole('Superadmin');
        // User::create(
        //     [
        //         'name' => 'PUSKESMAS BATANGTORU',
        //         'email' => 'puskesmasbatangtoru@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('password'),
        //         'is_active' => 1,
        //     ]
        // )->assignRole('Puskesmas');

        // User::create(
        //     [
        //         'name' => 'PUSKESMAS SIPIROK',
        //         'email' => 'puskesmassipirok@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('password'),
        //         'is_active' => 1,
        //     ]
        // )->assignRole('Puskesmas');

        // User::create(
        //     [
        //         'name' => 'PUSKESMAS TES',
        //         'email' => 'puskesmastes@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('password'),
        //         'is_active' => 1,
        //     ]
        // )->assignRole('Puskesmas');


        // User::create(
        //     [
        //         'name' => 'PENINJAU',
        //         'email' => 'peninjau@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('password'),
        //         'is_active' => 1,
        //     ]
        // )->assignRole('Peninjau');

        // User::create(
        //     [
        //         'name' => 'Administrator',
        //         'email' => 'administrator@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('password'),
        //         'is_active' => 1,
        //     ]
        // )->assignRole('Administrator');

        // User::create(
        //     [
        //         'name' => 'DINAS KESEHATAN DAERAH TAPSEL',
        //         'email' => 'dinkestapsel@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('password'),
        //         'is_active' => 1,
        //     ]
        // )->assignRole('Superadmin');

        // User::create(
        //     [
        //         'name' => 'YOVIANSYAH RIZKI PRATAMA',
        //         'email' => 'yoviansyahrizkypratama@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => bcrypt('password'),
        //         'is_active' => 1,
        //     ]
        // )->assignRole('Superadmin');
    }
}
