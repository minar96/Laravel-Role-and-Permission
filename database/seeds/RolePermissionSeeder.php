<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create Role
        $roleSuperAdmin 	= Role::create(['name' => 'superadmin']);
        $roleAdmin 			= Role::create(['name' => 'admin']);
        $roleEditor 		= Role::create(['name' => 'editor']);
        $roleUser 			= Role::create(['name' => 'user']);


        //create permission as an array
        $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    //dashboard permission
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],

            [
                'group_name' => 'admin',
                'permissions' => [
                  //admin permission
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],

            [
                'group_name' => 'blog',
                'permissions' => [
                 //blog permission

                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',

                ]
            ], 

            [
                'group_name' => 'role',
                'permissions' => [
                //role permission

                'role.create',
                'role.view',
                'role.edit',
                'role.delete',
                'role.approve',

                ]
            ],

            [
                'group_name' => 'profile',
                'permissions' => [
               
            //profile permission
            'profile.view',
            'profile.edit'

                ]
            ],
            
        ];

        //create and assign permission
        for ($i=0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
             for ($j=0; $j < count($permissions[$i]['permissions']); $j++) {
            	//create permission
    $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
            	$roleSuperAdmin->givePermissionTo($permission);
    			$permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
