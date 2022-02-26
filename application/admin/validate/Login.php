<?php
namespace app\admin\validate;

use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'verify'   => 'require|captcha'
    ];

    protected $message = [
        'username.require' => '请输入用户名',
        'password.require' => '请输入密码',
        'verify.require'   => '请输入验证码',
        'verify.captcha'   => '验证码不正确'
    ];
}