<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Profile;
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
        ]);

        Page::create([
            'label' => 'Users',
            'route' => 'users',
            'icon' => 'fas.users',
            'page_id' => 1,
            'type' => 'page',
            'order' => 1,
        ]);

        Page::create([
            'label' => 'Pages',
            'route' => 'pages',
            'icon' => 'fas.globe',
            'page_id' => 1,
            'type' => 'page',
            'order' => 2,
        ]);

        Page::create([
            'label' => 'Menus',
            'route' => 'menus',
            'icon' => 'fas.layer-group',
            'page_id' => 1,
            'type' => 'page',
            'order' => 3,
        ]);

        Page::create([
            'label' => 'Roles',
            'route' => 'roles',
            'icon' => 'fas.tag',
            'page_id' => 1,
            'type' => 'page',
            'order' => 4,
        ]);
        
        Page::create([
            'label' => 'Permissions',
            'route' => 'permissions',
            'icon' => 'fas.lock',
            'page_id' => 1,
            'type' => 'page',
            'order' => 5,
        ]);
        
        Page::create([
            'label' => 'Profiles',
            'route' => 'profiles',
            'icon' => 'fas.user-tag',
            'page_id' => 1,
            'type' => 'page',
            'order' => 6,
        ]);

        Page::create([
            'label' => 'Areas',
            'route' => 'areas',
            'icon' => 'fas.building',
            'page_id' => 1,
            'type' => 'page',
            'order' => 7,
        ]);

        
        $menu = Menu::create([
            'name' => 'Sysadmin'
        ]);

        
        $menu->pages()->sync(Page::all()->pluck('id'));

        
        Permission::create([
            'name' => 'view list users',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        Permission::create([
            'name' => 'store user',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        Permission::create([
            'name' => 'edit user',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        Permission::create([
            'name' => 'delete user',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        Permission::create([
            'name' => 'reset password user',
            'guard_name' => 'web',
            'module' => 'users'
        ]);
        Permission::create([
            'name' => 'view list pages',
            'guard_name' => 'web',
            'module' => 'pages'
        ]);
        Permission::create([
            'name' => 'store page',
            'guard_name' => 'web',
            'module' => 'pages'
        ]);
        Permission::create([
            'name' => 'edit page',
            'guard_name' => 'web',
            'module' => 'pages'
        ]);
        Permission::create([
            'name' => 'delete page',
            'guard_name' => 'web',
            'module' => 'pages'
        ]);
        Permission::create([
            'name' => 'view list menus',
            'guard_name' => 'web',
            'module' => 'menus'
        ]);
        Permission::create([
            'name' => 'store menu',
            'guard_name' => 'web',
            'module' => 'menus'
        ]);
        Permission::create([
            'name' => 'edit menu',
            'guard_name' => 'web',
            'module' => 'menus'
        ]);
        Permission::create([
            'name' => 'delete menu',
            'guard_name' => 'web',
            'module' => 'menus'
        ]);
        Permission::create([
            'name' => 'view list roles',
            'guard_name' => 'web',
            'module' => 'roles'
        ]);
        Permission::create([
            'name' => 'store role',
            'guard_name' => 'web',
            'module' => 'roles'
        ]);
        Permission::create([
            'name' => 'edit role',
            'guard_name' => 'web',
            'module' => 'roles'
        ]);
        Permission::create([
            'name' => 'delete role',
            'guard_name' => 'web',
            'module' => 'roles'
        ]);
        Permission::create([
            'name' => 'view list permissions',
            'guard_name' => 'web',
            'module' => 'permissions'
        ]);
        Permission::create([
            'name' => 'store permission',
            'guard_name' => 'web',
            'module' => 'permissions'
        ]);
        Permission::create([
            'name' => 'edit permission',
            'guard_name' => 'web',
            'module' => 'permissions'
        ]);
        Permission::create([
            'name' => 'delete permission',
            'guard_name' => 'web',
            'module' => 'permissions'
        ]);

        Permission::create([
            'name' => 'view list profiles',
            'guard_name' => 'web',
            'module' => 'profiles'
        ]);
        Permission::create([
            'name' => 'store profile',
            'guard_name' => 'web',
            'module' => 'profiles'
        ]);
        Permission::create([
            'name' => 'edit profile',
            'guard_name' => 'web',
            'module' => 'profiles'
        ]);
        Permission::create([
            'name' => 'delete profile',
            'guard_name' => 'web',
            'module' => 'profiles'
        ]);

        $role = Role::create([
            'name' => 'Sysadmin'
        ]);

        $role->permissions()->sync(Permission::all()->pluck('id'));

        Profile::create([
            'name' => 'Sysadmin',
            'description' => 'lorem ipsmun all for get status for greate',
            'role_id' => 1,
            'menu_id' => 1,
        ]);

        User::create([
            'cui' => '2733271000101',
            'password' => bcrypt('Cyb3rn3lsk8'),
            'profile_id' => 1,
            'area_id' => 1,
            'user_type_id' => 1,
        ]);


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
