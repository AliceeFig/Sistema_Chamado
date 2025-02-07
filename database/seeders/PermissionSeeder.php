<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        array_map(function ($permission) {
            Permission::create(['name' => $permission]);            
        },array_column(PermissionEnum::cases(), 'value'));
    }
}
