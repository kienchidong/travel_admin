<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use \App\AdminModel;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ROLE_SUPER_ADMIN = Role::create(['guard_name' => 'admin', 'name' => ROLE_SUPER_ADMIN]);
        $ROLE_ADMINSTRATOR = Role::create(['guard_name' => 'admin', 'name' => ROLE_ADMINSTRATOR]);


        /* permission account */
        $PERMISSION_ACCOUNT_VIEW = Permission::create(['guard_name' => 'admin', 'name' => PERMISSION_ACCOUNT_VIEW]);
        $PERMISSION_ACCOUNT_ADD = Permission::create(['guard_name' => 'admin', 'name' => PERMISSION_ACCOUNT_ADD]);
        $PERMISSION_ACCOUNT_EDIT = Permission::create(['guard_name' => 'admin', 'name' => PERMISSION_ACCOUNT_EDIT]);
        $PERMISSION_ACCOUNT_DELETE = Permission::create(['guard_name' => 'admin', 'name' => PERMISSION_ACCOUNT_DELETE]);
        /* permission account */


        $ROLE_SUPER_ADMIN->syncPermissions(
            $PERMISSION_ACCOUNT_VIEW,
            $PERMISSION_ACCOUNT_ADD,
            $PERMISSION_ACCOUNT_EDIT,
            $PERMISSION_ACCOUNT_DELETE
        );

        $ROLE_ADMINSTRATOR->syncPermissions(
            $PERMISSION_ACCOUNT_VIEW,
            $PERMISSION_ACCOUNT_ADD,
            $PERMISSION_ACCOUNT_EDIT
        );

        //admin
        $admin = AdminModel::find(1);
        $admin->givePermissionTo(Permission::all()->pluck('id'));
    }
}
