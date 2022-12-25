<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'show spm']);
        Permission::create(['name' => 'create spm']);
        Permission::create(['name' => 'edit spm']);
        Permission::create(['name' => 'delete spm']);
        Permission::create(['name' => 'submission spm']);
        Permission::create(['name' => 'approval spm']);
        Permission::create(['name' => 'report spm']);
        Permission::create(['name' => 'show priority']);
        Permission::create(['name' => 'create priority']);
        Permission::create(['name' => 'edit priority']);
        Permission::create(['name' => 'delete priority']);
        Permission::create(['name' => 'submission priority']);
        Permission::create(['name' => 'approval priority']);
        Permission::create(['name' => 'report priority']);
        Permission::create(['name' => 'show puskesmas_profile']);
        Permission::create(['name' => 'create puskesmas_profile']);
        Permission::create(['name' => 'edit puskesmas_profile']);
        Permission::create(['name' => 'delete puskesmas_profile']);
        Permission::create(['name' => 'show announcement']);
        Permission::create(['name' => 'create announcement']);
        Permission::create(['name' => 'edit announcement']);
        Permission::create(['name' => 'delete announcement']);
        Permission::create(['name' => 'publish announcement']);
        Permission::create(['name' => 'show notification']);
        Permission::create(['name' => 'create notification']);
        Permission::create(['name' => 'edit notification']);
        Permission::create(['name' => 'delete notification']);
        Permission::create(['name' => 'publish notification']);
        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'banned user']);
        Permission::create(['name' => 'active user']);
        Permission::create(['name' => 'show slider']);
        Permission::create(['name' => 'create slider']);
        Permission::create(['name' => 'edit slider']);
        Permission::create(['name' => 'delete slider']);
        Permission::create(['name' => 'edit account']);
        Permission::create(['name' => 'edit dinas']);

        Role::create(['name' => 'Superadmin'])
            ->givePermissionTo(
                [
                    'show spm',
                    'approval spm',
                    'report spm',
                    'show priority',
                    'approval priority',
                    'report priority',
                    'edit account',
                    'edit dinas',
                    'show slider',
                    'create slider',
                    'edit slider',
                    'delete slider',
                    'show announcement',
                    'create announcement',
                    'edit announcement',
                    'delete announcement',
                    'publish announcement',
                    'show notification',
                    'create notification',
                    'edit notification',
                    'delete notification',
                    'publish notification',
                    'show user',
                    'create user',
                    'edit user',
                    'banned user',
                    'active user',
                ]
            );

        Role::create(['name' => 'Administrator'])
            ->givePermissionTo([
                'show spm',
                'approval spm',
                'report spm',
                'show priority',
                'approval priority',
                'report priority',
                'edit account',
                'edit dinas',
                'show slider',
                'create slider',
                'edit slider',
                'delete slider',
                'show announcement',
                'create announcement',
                'edit announcement',
                'delete announcement',
                'publish announcement',
                'show notification',
                'create notification',
                'edit notification',
                'delete notification',
                'publish notification',
            ]);

        Role::create(['name' => 'Puskesmas'])
            ->givePermissionTo([
                'show spm',
                'create spm',
                'edit spm',
                'delete spm',
                'submission spm',
                'report spm',
                'show priority',
                'create priority',
                'edit priority',
                'delete priority',
                'submission priority',
                'report priority',
                'show puskesmas_profile',
                'create puskesmas_profile',
                'edit puskesmas_profile',
                'delete puskesmas_profile',
                'edit account'
            ]);

        Role::create(['name' => 'Peninjau'])
            ->givePermissionTo(
                [
                    'show spm',
                    'show priority',
                    'show puskesmas_profile',
                    'report spm',
                    'report priority',
                    'edit account'
                ]
            );
    }
}
