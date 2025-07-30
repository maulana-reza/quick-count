<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Admin User',
            'email' => 'admin',
            'password' => bcrypt('password'),
        ];
        $saksi = [
            'name' => 'Saksi User',
            'email' => 'saksi',
            'password' => bcrypt('password'),
        ];
        $saksi_admin = [
            'name' => 'Saksi Admin',
            'email' => 'saksi_admin',
            'password' => bcrypt('password'),
        ];
        $koordinator_saksi = [
            'name' => 'Koordinator Saksi',
            'email' => 'koordinator_saksi',
            'password' => bcrypt('password'),
        ];
        $permissions = [
            'admin-dashboard',
            'saksi-dashboard',
            'saksi-admin-dashboard',
            'manage users',
            'saksi',
            'saksi-admin',
            'view-reports',
            'formulir-c1',
            'saksi-koordinator',
            'paslon',
            'formulir-c1-validasi',
            'call-center',
        ];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
        $roles = [
            'admin' => [
                'admin-dashboard',
                'manage users',
                'view-reports',
                'formulir-c1',
                'saksi',
                'saksi-admin',
                'saksi-koordinator',
                'paslon',
                'call-center',
            ],
            'saksi' => [
                'saksi-dashboard',
                'saksi',
                'view-reports',
            ],
            'saksi_admin' => [
                'saksi-admin-dashboard',
                'saksi',
                'view-reports',
                'formulir-c1-validasi',
            ],
            'koordinator_saksi' => [
                'saksi-dashboard',
                'saksi',
                'view-reports',
            ]
        ];
        foreach ($roles as $role => $perms) {
            $roleModel = \Spatie\Permission\Models\Role::updateOrCreate(['name' => $role]);
            $roleModel->syncPermissions($perms);

        }
        $adminUser = User::where('email', $admin['email'])->first();
        if ($adminUser) {
            $adminUser->syncRoles(['admin']);
        }

        $adminUser = User::updateOrCreate(
            [
                'email' => $admin['email']
            ],
            [
                'email' => $admin['email'],
                'name' => $admin['name'],
                'password' => $admin['password'],
                'last_login_at' => now(),
                'last_seen_at' => now(),
            ]
        );
        $adminUser->syncRoles(['admin']);
        $saksiUser = User::updateOrCreate(
            [
                'email' => $saksi['email']
            ],
            [
                'email' => $saksi['email'],
                'name' => $saksi['name'],
                'password' => $saksi['password'],
                'last_login_at' => now(),
                'last_seen_at' => now(),
            ]
        );
        $saksiUser->syncRoles(['saksi']);
        $saksiAdminUser = User::updateOrCreate(
            [
                'email' => $saksi_admin['email']
            ],
            [
                'email' => $saksi_admin['email'],
                'name' => $saksi_admin['name'],
                'password' => $saksi_admin['password'],
                'last_login_at' => now(),
                'last_seen_at' => now(),
            ]
        );
        $saksiAdminUser->syncRoles(['saksi_admin']);
        $koordinatorSaksiUser = User::updateOrCreate(
            [
                'email' => $koordinator_saksi['email']
            ],
            [
                'email' => $koordinator_saksi['email'],
                'name' => $koordinator_saksi['name'],
                'password' => $koordinator_saksi['password'],
                'last_login_at' => now(),
                'last_seen_at' => now(),
            ]
        );
        $koordinatorSaksiUser->syncRoles(['koordinator_saksi']);

    }
}
