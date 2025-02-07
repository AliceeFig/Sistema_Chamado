<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions(array_column(PermissionEnum::cases(), 'value'));
    
        $padrao = Role::create(['name' => 'padrao']);
        $padrao->syncPermissions([
            PermissionEnum::CRIAR_CHAMADA->value,
            PermissionEnum::VISUALIZAR_CHAMADA->value,
            PermissionEnum::EDITAR_CHAMADA->value,
            PermissionEnum::DELETAR_CHAMADA->value,
        ]);
    }
}
