<?php
namespace app\admin\validate;

use think\Validate;

class Password extends Validate
{
    protected $rule = [
        's_password'       => 'require',
        'password'         => 'confirm:repassword|length:6,12',
        'repassword' 	   => 'confirm:password',
    ];

    protected $message = [
        's_password.require'       => '请输入密码',
        'password.length'          => '密码长度6-12位',
        'password.confirm'         => '两次输入密码不一致',
        'repassword.confirm'       => '两次输入密码不一致',
    ];
}