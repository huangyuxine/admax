<?php
namespace app\admin\controller;

use think\Controller;
use app\common\controller\Admin;
use app\admin\service\MenuService;
use app\admin\model\AuthMenu as AuthMenuModel;

class Menu extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new AuthMenuModel();
    }

    public function index()
    {
        $menuService = new MenuService();

        if ($this->request->isAjax()) {
            $list = $this->model->getMenuList();
            $count = $this->model->count();
            $list = $menuService->buildMenuType($list);
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

    public function create($id = 0)
    {
        $menus = $this->model->getPidMenuList();
    	return $this->fetch('', ['menus' => $menus, 'id' => $id]);
    }

    public function save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $validateResult = $this->validate($data, 'Menu');
            if ($validateResult !== true) {
                $this->error($validateResult);
            }
            $data['icon'] = "layui-icon ".$data['icon'];
            $result = $this->model->save($data);

            if ($result) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        $this->error('非法操作');
    }

    public function edit($id)
    {
        $data  = $this->model->find($id);
        empty($data) && $this->error('数据不存在');
        $menus = $this->model->getPidMenuList();
        return $this->fetch('', ['menus' => $menus, 'data' => $data]);
    }

    public function update()
    {
        if ($this->request->isPut()) {
            $data = $this->request->put();
            $validateResult = $this->validate($data, 'Menu');
            if ($validateResult !== true) {
                $this->error($validateResult);
            }
            $data['icon'] = "layui-icon ".$data['icon'];
            $result = $this->model->allowField(true)->save($data, ['id' => $data['id']]);

            if ($result) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        $this->error('非法操作');
    }

    public function status()
    {
        if ($this->request->isPut()) {
            $data = $this->request->put();
            $result = $this->model->allowField(true)->save($data, ['id' => $data['id']]);
            if ($result) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
    }

    public function delete()
    {
        if ($this->request->isDelete()) {
            $data = $this->request->delete();
            $child = $this->model->where(['pid' => $data['id']])->find();
            if ($child) {
                $this->error('分类下有子类，删除失败');
            }
            $result = $this->model->destroy($data['id']);
            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
        $this->error('非法操作');        
    }

    
}
