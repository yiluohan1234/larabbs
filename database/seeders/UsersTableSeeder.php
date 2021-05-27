<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        // 生成数据集合
        User::factory()->count(10)->create();


        $users = User::all();
        foreach($users as $user){
            // 单独处理第一个用户的数据
            if ($user->id == 1){
                $user->name = 'yiluohan1234';
                $user->email = '1097189275@qq.com';
                $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
                $user->save();
                // 初始化用户角色，将 1 号为『管理员』
                $user->assignRole('admin');
            }else{
                // 其他用户为user
                $user->assignRole('user');
            }
        }
    }
}