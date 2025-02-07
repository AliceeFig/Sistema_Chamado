<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
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
        
        $this->call([
            SetorSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class
        ]);

        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@chamadas.com',
            'password' => Hash::make("12345678")
        ]);

        $admin->assignRole('admin');
    }
}
