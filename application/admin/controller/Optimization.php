<?php
namespace app\admin\controller;

use think\Controller;
use app\common\controller\Admin;

class Optimization extends Admin
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $list = db()->query('SHOW TABLE STATUS');
            $count = count($list);
            $data = [
                'code'  => 0,
                'msg'   => '',
                'count' => $count,
                'data'  => $list,
            ];
            return json($data);
        }
    	
        return $this->fetch();
    }

    public function maintain()
    {
        $list = db()->query('SHOW TABLE STATUS');

        foreach ($list as $key => $value) {
            db()->query("OPTIMIZE TABLE `{$value['Name']}`");
        }

        $this->success("优化成功");
    }

}
