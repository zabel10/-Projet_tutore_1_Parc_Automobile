<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage_users',
            'manage_vehicules',
            'manage_conducteurs',
            'manage_missions',
            'manage_maintenances',
            'manage_carburants',
            'manage_assurances',
            'manage_alertes',
            'view_dashboard',
            'view_missions',
            'create_carburant',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $gestionnaireRole = Role::firstOrCreate(['name' => 'gestionnaire', 'guard_name' => 'web']);
        $conducteurRole = Role::firstOrCreate(['name' => 'conducteur', 'guard_name' => 'web']);

        Role::findByName('admin')->syncPermissions(Permission::all());

        Role::findByName('gestionnaire')->syncPermissions([
            'manage_vehicules',
            'manage_conducteurs',
            'manage_missions',
            'manage_maintenances',
            'manage_carburants',
            'manage_assurances',
            'manage_alertes',
            'view_dashboard',
        ]);

        Role::findByName('conducteur')->syncPermissions([
            'view_dashboard',
            'view_missions',
            'create_carburant',
        ]);
    }
}
