<?php
namespace app\admin\controller;

use app\common\model\System as SystemModel;
use app\common\controller\Admin;

class System extends Admin
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new SystemModel();
    }

	public function index()
	{
        $data = $this->model->getSystemConfig();
		return $this->fetch('index', ['data' => $data]);
	}

    public function update()
    {
        if ($this->request->isPut()) {
            $data = $this->request->put();
            $data = json_encode($data);
            $result = $this->model->save(['value' => $data], ['id' => 1]);
            if ($result) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
         $this->error('方法错误');
    }
}

