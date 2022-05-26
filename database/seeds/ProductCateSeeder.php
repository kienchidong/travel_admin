<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class ProductCateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ROLE_SUPER_ADMIN = Role::where(['guard_name' => 'admin', 'name' => ROLE_SUPER_ADMIN])->first();
        $ROLE_ADMINSTRATOR = Role::where(['guard_name' => 'admin', 'name' => ROLE_ADMINSTRATOR])->first();

        /* permission account */
        $PERMISSION_PRODUCT_CATE_VIEW= Permission::create(['guard_name' => 'admin', 'name' => PERMISSION_PRODUCT_CATE_VIEW]);
        $PERMISSION_PRODUCT_CATE_ADD = Permission::create(['guard_name' => 'admin', 'name' => PERMISSION_PRODUCT_CATE_ADD]);
        $PERMISSION_PRODUCT_CATE_EDIT = Permission::create(['guard_name' => 'admin', 'name' => PERMISSION_PRODUCT_CATE_EDIT]);
        $PERMISSION_PRODUCT_CATE_DELETE = Permission::create(['guard_name' => 'admin', 'name' => PERMISSION_PRODUCT_CATE_DELETE]);

        /* permission account */

        \Illuminate\Support\Facades\DB::table('role_has_permissions')->insert([
            [
                'permission_id' => $PERMISSION_PRODUCT_CATE_VIEW->id,
                'role_id' => $ROLE_SUPER_ADMIN->id,
            ], [
                'permission_id' => $PERMISSION_PRODUCT_CATE_VIEW->id,
                'role_id' => $ROLE_ADMINSTRATOR->id,
            ],[
                'permission_id' => $PERMISSION_PRODUCT_CATE_ADD->id,
                'role_id' => $ROLE_SUPER_ADMIN->id,
            ], [
                'permission_id' => $PERMISSION_PRODUCT_CATE_ADD->id,
                'role_id' => $ROLE_ADMINSTRATOR->id,
            ],[
                'permission_id' => $PERMISSION_PRODUCT_CATE_EDIT->id,
                'role_id' => $ROLE_SUPER_ADMIN->id,
            ], [
                'permission_id' => $PERMISSION_PRODUCT_CATE_EDIT->id,
                'role_id' => $ROLE_ADMINSTRATOR->id,
            ],[
                'permission_id' => $PERMISSION_PRODUCT_CATE_DELETE->id,
                'role_id' => $ROLE_SUPER_ADMIN->id,
            ], [
                'permission_id' => $PERMISSION_PRODUCT_CATE_DELETE->id,
                'role_id' => $ROLE_ADMINSTRATOR->id,
            ],
        ]);

    }
}
