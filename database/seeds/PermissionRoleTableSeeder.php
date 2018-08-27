<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $admin = Role::create(['name' => 'administrator']);
        $moderator = Role::create(['name' => 'moderator']);
        $user = Role::create(['name' => 'user']);

        // Create Permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage articles']);
        Permission::create(['name' => 'view articles']);

        $admin->syncPermissions(['manage users', 'manage articles', 'view articles']);
        $moderator->givePermissionTo(['manage articles', 'view articles']);
        $user->givePermissionTo(['view articles']);

        User::find(1)->assignRole($admin);
        User::find(2)->assignRole($moderator);
        User::find(3)->assignRole($user);
    }
}
