<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');
        $roles = [
            'admin',
            'user'
        ];
        $permissions = [
            'dashboard',
            'file_manager',
            'backup_manager',
            'log_manager',
            'permission_manager',
            'setting_manager',
            'wiki_manager'

        ];
        // 先创建权限:管理用户,编辑设置
        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        // Permission::create(['name' => 'manage_users']);
        // Permission::create(['name' => 'edit_settings']);

        // 创建管理员角色，并赋予权限
        $admin = Role::create(['name' => 'admin']);
        foreach($permissions as $permission){
            $admin->givePermissionTo($permission);
        }
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('dashboard');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 需清除缓存，否则会报错
        app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // 清空所有数据表数据
        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}