<?php
namespace app\admin\validate;

use think\Validate;

class AuthGroup extends Validate
{
    protected $rule = [
        'title'  =>  'require|max:20',
        'rules'  =>  'require',
    ];

    protected $message = [
        'title.require' => '请输入权限组名称',
        'title.max'     => '权限组名称不能超过20个字符',
        'rules'         => '权限不能为空'
    ];
}