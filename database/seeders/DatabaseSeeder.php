<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Page;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Area::create([
            'name' => 'GERENCIA DE DESARROLLO SOCIAL',
        ]);
        
        Area::create([
            'name' => 'DIRECCIÓN DE SALUD Y BIENESTAR',
            'area_id' => 1
        ]);
        
        Area::create([
            'name' => 'DIRECCIÓN DE DESARROLLO SOCIAL',
            'area_id' => 1
        ]);

        Area::create([
            'name' => 'DIRECCIÓN DE EDUCACIÓN Y CULTURA',
            'area_id' => 1
        ]);

        Area::create([
            'name' => 'DIRECCIÓN MUNICIPAL DE LA MUJER',
            'area_id' => 1
        ]);

        Area::create([
            'name' => 'DIRECCIÓN DE COMERCIO POPULAR',
            'area_id' => 1
        ]);

        Area::create([
            'name' => 'SECRETARÍA DE ASUNTOS SOCIALES',
            'area_id' => 1
        ]);

        Area::create([
            'name' => 'UNIDAD DE CONVIVENCIA SOCIAL',
            'area_id' => 1
        ]);


        UserType::create([
            'name' => 'INTERNO'
        ]);

        UserType::create([
            'name' => 'EXTERNO'
        ]);


        Page::create([
            'label' => 'Admin',
            'icon' => 'fas.shield',
            'type' => 'parent',
            'order' => 1,
            'permission_name' => 'page.view.admin'
        ]);

        Page::create([
            'label' => 'Users',
            'route' => 'user.index',
            'icon' => 'fas.users',
            'page_id' => 1,
            'type' => 'page',
            'order' => 1,
            'permission_name' => 'page.view.users'
        ]);

        Page::create([
            'label' => 'Pages',
            'route' => 'pages',
            'icon' => 'fas.globe',
            'page_id' => 1,
            'type' => 'page',
            'order' => 2,
            'permission_name' => 'page.view.pages'
        ]);


        Page::create([
            'label' => 'Roles',
            'route' => 'roles',
            'icon' => 'fas.tag',
            'page_id' => 1,
            'type' => 'page',
            'order' => 3,
            'permission_name' => 'page.view.roles'
        ]);
        
        Page::create([
            'label' => 'Permissions',
            'route' => 'permissions',
            'icon' => 'fas.lock',
            'page_id' => 1,
            'type' => 'page',
            'order' => 4,
            'permission_name' => 'page.view.permissions'
        ]);
        

        Page::create([
            'label' => 'Areas',
            'route' => 'areas',
            'icon' => 'fas.building',
            'page_id' => 1,
            'type' => 'page',
            'order' => 5,
            'permission_name' => 'page.view.areas'
        ]);

        
        Permission::create([
            'name' => 'users.view',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        Permission::create([
            'name' => 'users.store',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        Permission::create([
            'name' => 'users.edit',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        
        Permission::create([
            'name' => 'users.disabled',
            'guard_name' => 'web',
            'module' => 'users'
        ]);

        Permission::create([
            'name' => 'users.reset.password',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        Permission::create([
            'name' => 'pages.view',
            'guard_name' => 'web',
            'module' => 'pages'
        ]);
        Permission::create([
            'name' => 'pages.store',
            'guard_name' => 'web',
            'module' => 'pages'
        ]);
        Permission::create([
            'name' => 'pages.edit',
            'guard_name' => 'web',
            'module' => 'pages'
        ]);
        Permission::create([
            'name' => 'pages.disabled',
            'guard_name' => 'web',
            'module' => 'pages'
        ]);

        Permission::create([
            'name' => 'roles.view',
            'guard_name' => 'web',
            'module' => 'roles'
        ]);
        Permission::create([
            'name' => 'roles.store',
            'guard_name' => 'web',
            'module' => 'roles'
        ]);
        Permission::create([
            'name' => 'roles.edit',
            'guard_name' => 'web',
            'module' => 'roles'
        ]);
        Permission::create([
            'name' => 'roles.delete',
            'guard_name' => 'web',
            'module' => 'roles'
        ]);
        Permission::create([
            'name' => 'permissions.view',
            'guard_name' => 'web',
            'module' => 'permissions'
        ]);
        Permission::create([
            'name' => 'permissions.store',
            'guard_name' => 'web',
            'module' => 'permissions'
        ]);
        Permission::create([
            'name' => 'permissions.edit',
            'guard_name' => 'web',
            'module' => 'permissions'
        ]);

        Permission::create([
            'name' => 'permissions.delete',
            'guard_name' => 'web',
            'module' => 'permissions'
        ]);

        // PERMISOS PARA VISUALIZAR LAS PAGINAS O HASTA RUTAS

        Permission::create([
            'name' => 'page.view.admin',
            'guard_name' => 'web',
            'module' => 'menu'
        ]);

        Permission::create([
            'name' => 'page.view.users',
            'guard_name' => 'web',
            'module' => 'menu'
        ]);

        Permission::create([
            'name' => 'page.view.pages',
            'guard_name' => 'web',
            'module' => 'menu'
        ]);

        Permission::create([
            'name' => 'page.view.roles',
            'guard_name' => 'web',
            'module' => 'menu'
        ]);

        Permission::create([
            'name' => 'page.view.permissions',
            'guard_name' => 'web',
            'module' => 'menu'
        ]);

        Permission::create([
            'name' => 'page.view.areas',
            'guard_name' => 'web',
            'module' => 'menu'
        ]);


        $role = Role::create([
            'name' => 'Sysadmin'
        ]);

        $role->permissions()->sync(Permission::all()->pluck('id'));


        $user = User::create([
            'cui' => '2733271000101',
            'password' => bcrypt('Cyb3rn3lsk8'),
            'area_id' => 1,
            'user_type_id' => 1,
        ]);

        $user->assignRole('Sysadmin');

        UserInformation::create([
            'first_name' => 'Nelson',
            'last_name' => 'Vásquez',
            'cui' => '2733271000101',
            'phone' => '48840150',
            'birthday' => '1988-06-23',
            'city' => 'Guatemala',
            'address' => '2 calle 1-02 zona 3 anexo Ruedita',
            'email' => 'nelson.o.vasquez@gmail.com',
            'gender' => 'M',
            'user_id' => 1
        ]);


    }
}
