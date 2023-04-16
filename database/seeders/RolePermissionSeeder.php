<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $permission = [
            'dashboard' => [
                'dashboard.index',
            ],
            'post' => [
                'post.index', 'post.create', 'post.edit', 'post.delete'
            ],
            'category_post' => [
                'category_post.index', 'category_post.create', 'category_post.edit', 'category_post.delete'
            ],
            'product' => [
                'product.index', 'product.create', 'product.edit', 'product.delete'
            ],
            'category' => [
                'category.index', 'category.create', 'category.edit', 'category.delete'
            ],
            'chat' => [
                'chat.index', 'chat.create', 'chat.edit', 'chat.delete'
            ],
            'user' => [
                'user.index', 'user.create', 'user.edit', 'user.delete'
            ],
            'role' => [
                'role.index', 'role.create', 'role.edit', 'role.delete'
            ],
            'permission' => [
                'permission.index', 'permission.create', 'permission.edit', 'permission.delete'
            ],
            'order' => [
                'order.index', 'order.create', 'order.edit', 'order.delete'
            ],
            'transaction' => [
                'transaction.index', 'transaction.create', 'transaction.edit', 'transaction.delete'
            ],
            'warehouse' => [
                'warehouse.index', 'warehouse.create', 'warehouse.edit', 'warehouse.delete'
            ],

        ];


        collect($permission)->each(function ($value, $key) {
            collect($value)->each(function($v, $k){
                Permission::create([
                    'name'              => $v,
                    'guard_name'        => 'web'
                ]);
            });
        });



        $role = Role::create([
            'name'          => 'admin',
            'guard_name'    => 'web'
        ]);


        $role->givePermissionTo(collect($permission)->except(['user', 'role', 'permission'])->map(function ($v, $k) {
            unset($v[$k]);
            return $v;
        }));


        $role = Role::create([
            'name'          => 'developer',
            'guard_name'    => 'web'
        ]);


        $role->givePermissionTo(collect($permission)->map(function ($v, $k) {
            unset($v[$k]);
            return $v;
        }));


        $role = Role::create([
            'name'          => 'customer',
            'guard_name'    => 'web'
        ]);
        
        
        $role = Role::create([
            'name'          => 'sales',
            'guard_name'    => 'web'
        ]);

        $role->givePermissionTo(collect($permission)->except(['user', 'role', 'permission'])->map(function ($v, $k) {
            unset($v[$k]);
            return $v;
        }));
        
        $role = Role::create([
            'name'          => 'management cabang',
            'guard_name'    => 'web'
        ]);

        $role->givePermissionTo(collect($permission)->except(['user', 'role', 'permission'])->map(function ($v, $k) {
            unset($v[$k]);
            return $v;
        }));
    }
}
