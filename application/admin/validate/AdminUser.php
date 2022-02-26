<?php
namespace app\admin\validate;

use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        'username'         => 'require|unique:admin_user|max:10',
        'password'         => 'confirm:repassword|length:6,12',
        'repassword' 	   => 'confirm:password',
        'status'           => 'require',
        'group_id'         => 'require'
    ];

    protected $message = [
        'username.require'         => '请输入用户名',
        'username.max'             => '不能超过10个字符',
        'username.unique'          => '用户名已存在',
        'password.length'          => '密码长度6-12位',
        'password.confirm'         => '两次输入密码不一致',
        'repassword.confirm'       => '两次输入密码不一致',
        'status.require'           => '请选择状态',
        'group_id.require'         => '请选择所属权限组'
    ];
}