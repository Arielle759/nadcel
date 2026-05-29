<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les rôles
        $client = Role::create(['name' => 'client']);
        $employee = Role::create(['name' => 'employee']);
        $manager = Role::create(['name' => 'manager']);
        $admin = Role::create(['name' => 'admin']);

        // Créer quelques permissions de base
        Permission::create(['name' => 'view appointments']);
        Permission::create(['name' => 'create appointments']);
        Permission::create(['name' => 'cancel appointments']);
        Permission::create(['name' => 'manage salon']);
        Permission::create(['name' => 'manage employees']);
        Permission::create(['name' => 'manage services']);

        // Assigner permissions aux rôles
        $client->givePermissionTo(['view appointments', 'create appointments', 'cancel appointments']);
        $manager->givePermissionTo(['manage salon', 'manage employees', 'manage services']);
        $admin->givePermissionTo(Permission::all());
    }
}