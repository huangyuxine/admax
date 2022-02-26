<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use app\admin\model\AdminUser as AdminUserModel;
use app\admin\model\AuthGroup as AuthGroupModel;
class AdminUser extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminUserModel();
    }
    public function index()
    {
        if ($this->request->isAjax()) {
            $list = $this->model->getAdminerList();
            $count = $this->model->count();
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

    public function create()
    {
        $list = (new AuthGroupModel)->select();
        return $this->fetch('create', ['list'=>$list]);
    }

    public function save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $validateResult = $this->validate($data, 'AdminUser');

            if ($validateResult !== true) {
                $this->error($validateResult);
            }

            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $result = $this->model->allowField(true)->save($data);

            if ($result) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
         $this->error('方法错误');
    }

    public function edit($id)
    {
        $data  = $this->model->find($id);
        empty($data) && $this->error('数据不存在');
        $groups = (new AuthGroupModel)->select();
        return $this->fetch('', ['groups' => $groups, 'data' => $data]);

    }

    public function update()
    {
        if ($this->request->isPut()) {
            $data = $this->request->put();
            $validateResult = $this->validate($data, 'AdminUser');
            if ($validateResult !== true) {
                $this->error($validateResult);
            }
            if (!$data['password']){
                unset($data['password']);
            }else{
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }
            $result = $this->model->allowField(true)->save($data, ['id' => $data['id']]);

            if ($result) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
         $this->error('方法错误');
    }

    public function delete()
    {
        if ($this->request->isDelete()) {
            $data = $this->request->delete();
            $result = $this->model->destroy($data['id']);

            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
         $this->error('方法错误');        
    }
}
