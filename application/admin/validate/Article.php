<?php
namespace app\admin\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title'  =>  'require|max:30|unique:article',
        'cid'    =>  'require'
    ];

    protected $message = [
        'title.require' => '请输入标题',
        'title.max' 	=> '标题不能超过30字符',
        'pid.require'   => '请选择分类',
    ];
}