<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use think\facade\Cache;
use app\admin\model\AdminUser as AdminUserModel;

class Password extends Admin
{
    protected $adminUserModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminUserModel = new AdminUserModel();
    }

    public function index()
    {
    	return $this->fetch();
    }

    public function update()
    {
        if ($this->request->isPut()) {
            $data = $this->request->put();

            $validateResult = $this->validate($data, 'Password');

            if ($validateResult !== true) {
                $this->error($validateResult);
            }

            $adminUser = $this->adminUserModel->find(session('admin_id'));
            $checkPassword = password_verify($data['s_password'], $adminUser['password']);

            if (!$checkPassword) {
                $this->error('密码错误');
            }

            $password = password_hash($data['password'], PASSWORD_BCRYPT);
            $save['password']= $password;
            $result = $this->adminUserModel->save($save, ['id' => $adminUser['id']]);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }

        $this->error("方法错误");
    }
}
