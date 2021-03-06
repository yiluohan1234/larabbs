<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','ASC')->paginate(5);
        
        return view('fadmin.users.index',compact('data'));
    }
    public function show(User $user)
    {
        return view('fadmin.users.show', compact('user'));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('fadmin.users.edit', compact('user'));
    }
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
    // public function edit($id)
    // {
    //     $role = Role::find($id);
    //     $permission = Permission::get();
    //     $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
    //         ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    //         ->all();
    
    //     return view('fadmin.users.edit',compact('role','permission','rolePermissions'));
    // }
}