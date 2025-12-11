<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminRole = Role::create(['role_name' => 'admin']);
        $adminRole = Role::create(['role_name' => 'auditor']);
        $adminRole = Role::create(['role_name' => 'tim_mutu']);
        $adminRole = Role::create(['role_name' => 'unit_kerja']);
        $adminRole = Role::create(['role_name' => 'pimpinan']);
        $userRole = Role::create(['role_name' => 'guest']);

        $editor = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'username' => 'admin@example.com',
                'password' => bcrypt('Password@123')
            ]
        );
        $editor->assignRole('admin');
    }
}
