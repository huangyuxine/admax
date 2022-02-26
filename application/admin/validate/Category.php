<?php
namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'title'  =>  'require|max:20',
        'pid'    =>  'require'
    ];

    protected $message = [
        'title.require' => '请输入标题',
        'title.max' 	=> '标题不能超过20字符',
        'pid.require'   => '请选择上级分类',
    ];
}