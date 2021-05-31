<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, Notifiable, MustVerifyEmailTrait, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'introduction',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function setAvatarAttribute($path)
    // {
    //     // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
    //     if ( ! starts_with($path, 'http')) {

    //             $path = \Storage::disk('admin')->url($path);
    //             // 拼接完整的 URL
    //             //$path = config('app.url') . "/uploads/images/avatars/$path";
    //     }

    //     $this->attributes['avatar'] = $path;
    // }
}
