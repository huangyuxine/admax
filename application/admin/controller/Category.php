<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use app\common\model\Category as CategoryModel;
use app\common\model\Article as ArticleModel;

class Category extends Admin
{
	protected $model;

	public function __construct()
    {
        parent::__construct();
        $this->model = new CategoryModel();
    }

    public function index()
    {
        if ($this->request->isAjax()) {
            $list = $this->model->getCategoryList();
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
        $list = $this->model->getCategoryList();

    	return $this->fetch('create', ['list' => $list]);
	}

	public function save()
	{
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $validateResult = $this->validate($data, 'Category');

            if ($validateResult !== true) {
                $this->error($validateResult);
            }

            $save = $this->model->allowField(true)->save($data);

            if ($save) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        $this->error('方法错误');
	}

	public function edit($id)
	{
		$data = $this->model->find($id);
		empty($data) && $this->error('数据不存在');

        $list = $this->model->getCategoryList();
    	return $this->fetch('edit', ['data' => $data, 'list' => $list]);
	}

    public function update()
    {
        if ($this->request->isPut()) {
            $data = $this->request->put();
            $validateResult = $this->validate($data, 'Category');
            if ($validateResult !== true) {
                $this->error($validateResult);
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

            $child = $this->model->where(['pid' => $data['id']])->find();
            $article = (new ArticleModel())->where(['cid' => $data['id']])->find();

            if ($child || $article) {
                $this->error('分类下有文章或有子分类不可删除');
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
