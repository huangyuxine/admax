<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use think\facade\Cache;

class Index extends Admin
{
    public function index()
    {
    	return $this->fetch();
    }

    public function welcome()
    {
    	return $this->fetch();
    }

    public function clear()
    {
        Cache::clear();
        $this->success('清理缓存成功');
    }
}
