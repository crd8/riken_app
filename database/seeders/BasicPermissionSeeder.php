<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class BasicPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cache roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user list',
            'user create',
            'user edit',
            'user delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign existing permissions
        $roleWriter = Role::create(['name' => 'writer']);
        $roleWriter->givePermissionTo('permission list');
        $roleWriter->givePermissionTo('role list');
        $roleWriter->givePermissionTo('user list');

        $roleAdmin = Role::create(['name' => 'admin']);
        foreach ($permissions as $permission) {
            $roleAdmin->givePermissionTo($permission);
        }
        $roleSuperAdmin = Role::create(['name' => 'super-admin']);
        // Gets all permission via Gate::before rule; see AuthServiceProvider
        
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@app.com'
        ]);
        $user->assignRole($roleSuperAdmin);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@app.com'
        ]);
        $user->assignRole($roleAdmin);

        $user = \App\Models\User::factory()->create([
            'name' => 'Writer',
            'email' => 'writer@app.com'
        ]);
        $user->assignRole($roleWriter);
    }
}
