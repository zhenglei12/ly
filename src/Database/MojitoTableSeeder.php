<?php

namespace Cherish\Ly\Database;

use Illuminate\Database\Seeder;
use Cherish\Ly\AdminUserFactory;
use Cherish\Ly\Models\Menu;
use Cherish\Ly\Models\PermissionGroup;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MojitoTableSeeder extends Seeder
{
    private $permissions = [
        [
            'name' => 'admin-user.index',
            'display_name' => 'index',
            'pg_id' => 1
        ],
        [
            'name' => 'admin-user.show',
            'display_name' => 'show',
            'pg_id' => 1
        ],
        [
            'name' => 'admin-user.store',
            'display_name' => 'store',
            'pg_id' => 1
        ],
        [
            'name' => 'admin-user.update',
            'display_name' => 'update',
            'pg_id' => 1
        ],
        [
            'name' => 'admin-user.destroy',
            'display_name' => 'destroy',
            'pg_id' => 1
        ],
        [
            'name' => 'admin-user.roles',
            'display_name' => 'role list',
            'pg_id' => 1
        ],
        [
            'name' => 'admin-user.assign-roles',
            'display_name' => 'assign role',
            'pg_id' => 1
        ],
        [
            'name' => 'role.index',
            'display_name' => 'index',
            'pg_id' => 2
        ],
        [
            'name' => 'role.show',
            'display_name' => 'show',
            'pg_id' => 2
        ],
        [
            'name' => 'role.store',
            'display_name' => 'store',
            'pg_id' => 2
        ],
        [
            'name' => 'role.update',
            'display_name' => 'update',
            'pg_id' => 2
        ],
        [
            'name' => 'role.destroy',
            'display_name' => 'destroy',
            'pg_id' => 2
        ],
        [
            'name' => 'role.permissions',
            'display_name' => 'role permissions',
            'pg_id' => 2
        ],
        [
            'name' => 'role.assign-permissions',
            'display_name' => 'role assignment authority',
            'pg_id' => 2
        ],
        [
            'name' => 'role.guard-name-roles',
            'display_name' => 'Specify the role of guard name',
            'pg_id' => 2
        ],
        [
            'name' => 'permission.index',
            'display_name' => 'index',
            'pg_id' => 3
        ],
        [
            'name' => 'permission.show',
            'display_name' => 'show',
            'pg_id' => 3
        ],
        [
            'name' => 'permission.store',
            'display_name' => 'store',
            'pg_id' => 3
        ],
        [
            'name' => 'permission.update',
            'display_name' => 'update',
            'pg_id' => 3
        ],
        [
            'name' => 'permission.destroy',
            'display_name' => 'destroy',
            'pg_id' => 3
        ],
        [
            'name' => 'menu.index',
            'display_name' => 'index',
            'pg_id' => 4
        ],
        [
            'name' => 'menu.show',
            'display_name' => 'show',
            'pg_id' => 4
        ],
        [
            'name' => 'menu.store',
            'display_name' => 'store',
            'pg_id' => 4
        ],
        [
            'name' => 'menu.update',
            'display_name' => 'update',
            'pg_id' => 4
        ],
        [
            'name' => 'menu.destroy',
            'display_name' => 'destroy',
            'pg_id' => 4
        ],
        [
            'name' => 'permission-group.index',
            'display_name' => 'index',
            'pg_id' => 5
        ],
        [
            'name' => 'permission-group.show',
            'display_name' => 'show',
            'pg_id' => 5
        ],
        [
            'name' => 'permission-group.store',
            'display_name' => 'store',
            'pg_id' => 5
        ],
        [
            'name' => 'permission-group.update',
            'display_name' => 'update',
            'pg_id' => 5
        ],
        [
            'name' => 'permission-group.destroy',
            'display_name' => 'destroy',
            'pg_id' => 5
        ],
        [
            'name' => 'permission-group.guard-name-for-permission',
            'display_name' => 'Guard name for permissions',
            'pg_id' => 5
        ],
        [
            'name' => 'permission-group.all',
            'display_name' => 'All permission groups',
            'pg_id' => 5
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @author moell<moel91@foxmail.com>
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $this->createdAdminUser();

        $this->createPermissionGroup();

        $this->createRole();

        $this->createPermission();

        $this->createMenu();

        $this->associateRolePermissions();
    }

    /**
     * @author moell<moel91@foxmail.com>
     */
    private function createdAdminUser()
    {
        AdminUserFactory::adminUser()->truncate();

        AdminUserFactory::adminUser()->create([
            'name' => 'admin',
            'email' => 'admin@qq.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        ]);
    }

    /**
     * @author moell<moel91@foxmail.com>
     */
    private function createPermission()
    {
        Permission::query()->delete();

        foreach ($this->permissions as $permission) {
            $permission['guard_name'] = 'admin';
            Permission::create($permission);
        }
    }

    /**
     * @author moell<moel91@foxmail.com>
     */
    private function createPermissionGroup()
    {
        PermissionGroup::truncate();
        PermissionGroup::insert([
            [
                'id'    => 1,
                'name'  => 'Admin users',
            ], [
                'id'    => 2,
                'name'  => 'Role'
            ], [
                'id'    => 3,
                'name'  => 'Permission'
            ], [
                'id'    => 4,
                'name'  => 'Menu'
            ], [
                'id'    => 5,
                'name'  => 'Permission groups'
            ]
        ]);
    }

    /**
     * @author moell<moel91@foxmail.com>
     */
    private function createRole()
    {
        Role::query()->delete();
        Role::create([
            'name' => 'admin',
            'guard_name' => 'admin'
        ]);
    }

    /**
     * @author moell<moel91@foxmail.com>
     */
    private function createMenu()
    {
        Menu::truncate();
        Menu::insert([
            [
                'id'        => 1,
                'parent_id' => 0,
                'uri'       => '/admin/dashboard',
                'name'      => 'Dashboard',
                'icon'      => 'mofont mo-icon-dashboard mo-menu',
                'guard_name'=> 'admin'
            ],
            [
                'id'        => 2,
                'parent_id' => 0,
                'uri'       => '/admin/admin',
                'name'      => 'Admin',
                'icon'      => 'mofont mo-icon-admin mo-menu',
                'guard_name'=> 'admin'
            ],
            [
                'id'        => 3,
                'parent_id' => 2,
                'uri'       => '/admin/admin-user',
                'name'      => 'Admin user',
                'icon'      => '',
                'guard_name'=> 'admin'
            ],
            [
                'id'        => 4,
                'parent_id' => 2,
                'uri'       => '/admin/role',
                'name'      => 'Role',
                'icon'      => '',
                'guard_name'=> 'admin'
            ],
            [
                'id'        => 5,
                'parent_id' => 2,
                'uri'       => '/admin/permission',
                'name'      => 'Permission',
                'icon'      => '',
                'guard_name'=> 'admin'
            ],
            [
                'id'        => 6,
                'parent_id' => 2,
                'uri'       => '/admin/permission-group',
                'name'      => 'Permission Group',
                'icon'      => '',
                'guard_name'=> 'admin'
            ],
            [
                'id'        => 7,
                'parent_id' => 2,
                'uri'       => '/admin/menu',
                'name'      => 'Menu',
                'icon'      => '',
                'guard_name'=> 'admin'
            ],

        ]);
    }

    /**
     * @author moell<moel91@foxmail.com>
     */
    private function associateRolePermissions()
    {
        $role = Role::first();

        AdminUserFactory::adminUser()->first()->assignRole($role->name);

        foreach ($this->permissions as $permission) {
            $role->givePermissionTo($permission['name']);
        }
    }
}
