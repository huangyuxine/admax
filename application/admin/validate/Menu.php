<?php
namespace app\admin\validate;

use think\Validate;

class Menu extends Validate
{
    protected $rule = [
        'title'  =>  'require|max:10',
        'pid'    =>  'require'
    ];

    protected $message = [
        'title.require' => '请输入菜单名称',
        'title.max'     => '菜单名称不能超过10个字符',
        'pid.require'   => '请选择栏目',
    ];
}