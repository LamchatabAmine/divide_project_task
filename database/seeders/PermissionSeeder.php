<?php

namespace Database\Seeders;

use PermissionHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (PermissionHelper::generatePermissions() as $permission) {
            if (Permission::where('name', $permission)->doesntExist()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Get the leader role
        $leader = Role::where('name', 'leader')->first();

        // Get the Permission instances corresponding to the generated permissions
        $permissions = Permission::whereIn('name', PermissionHelper::generatePermissions())->get();

        // Give permissions to the leader role
        $leader->givePermissionTo($permissions);

        // Get the member role
        $member = Role::where('name', 'member')->first();

        // $member->givePermissionTo('index-Task', 'searchTask-Task');

        // Give 'member' role permissions for actions starting with 'index-' and 'search-'

        // $member->givePermissionTo(
        //     Permission::whereIn('name', function ($query) {
        //         $query->select('name')
        //             ->from('permissions')
        //             ->where('name', 'like', 'index%')
        //             ->orWhere('name', 'like', 'search%');
        //     })->get()
        // );


        $member->givePermissionTo(
            Permission::where('name', 'like', 'index%')
                ->where('name', 'not like', 'index-Member%')
                ->get()
        );

        $member->givePermissionTo(
            Permission::where('name', 'like', 'search%')
                ->where('name', 'not like', 'search-Member%')
                ->get()
        );



        // $member->givePermissionTo(Permission::where('name', 'like', 'index%')->get());
        // $member->givePermissionTo(Permission::where('name', 'like', 'search%')->get());


    }
}
