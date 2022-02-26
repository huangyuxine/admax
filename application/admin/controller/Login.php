<?php
namespace app\admin\controller;

use think\Controller;
use think\captcha\Captcha;
use app\admin\model\AdminUser as AdminUserModel;

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminUserModel();
    }

	public function index()
	{
		return $this->fetch();
	}

    public function login()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validateResult = $this->validate($data, 'Login');

            if ($validateResult !== true) {
                $this->error($validateResult);
            } 

            $where['username'] = $data['username'];
            $adminUser = $this->model->field('id,username,status,password')->where($where)->find();

            $result = password_verify($data['password'], $adminUser['password']);
            if (!$result) {
                $this->error('用户名或密码错误');
            }

            if ($adminUser['status'] != 1) {
                $this->error('当前用户已禁用');
            }
            session('admin_id', $adminUser['id']);
            session('admin_name', $adminUser['username']);
            $update = [
                    'last_login_time' => time(),
                    'last_login_ip'   => $this->request->ip(),
            ];
            $this->model->save($update,['id' => $adminUser['id']]);
            $this->success('登录成功', 'index/index');
        
        }       
    }
    /**
     * 用户退出
     */
    public function logout()
    {
        session('admin_id', null);
        session('admin_name', null);
        $this->success('退出登录成功');
    }
    /**
     * 验证码
     */
    public function captcha()
    {
    	$config  = config('captcha');
        $captcha = new Captcha($config);
        return $captcha->entry();   
    }
}

