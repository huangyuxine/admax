<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use app\common\model\Article as ArticleModel;
use app\common\model\Category as CategoryModel;

class Article extends Admin
{
	protected $model;

	public function __construct()
    {
        parent::__construct();
        $this->model = new ArticleModel();
    }

    public function index()
    {
        if ($this->request->isAjax()) {
            $page = input('get.page');
            $limit = input('get.limit');
            $limited = ($page - 1) * $limit;
            $keyword = input('get.keyword','');
            $data = ArticleModel::getArticleList($limited, $limit, $keyword);
            return json($data);
        }
    	return $this->fetch();
    }

    public function create()
	{
        $list = (new CategoryModel)->getCategoryList();

    	return $this->fetch('create', ['list' => $list]);
	}

	public function save()
	{
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $validateResult = $this->validate($data, 'Article');
            if ($validateResult !== true) {
                $this->error($validateResult);
            }
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
		$data = $this->model->find($id);
		empty($data) && $this->error('数据不存在');

        $list = (new CategoryModel)->getCategoryList();
    	return $this->fetch('edit', ['data' => $data, 'list' => $list]);
	}

    public function update()
    {
        if ($this->request->isPut()) {
            $data = $this->request->put();
            $validateResult = $this->validate($data, 'Article');
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
            $result = $this->model->destroy($data['id']);

            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
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
}
