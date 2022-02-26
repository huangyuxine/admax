<?php
namespace app\common\model;
use think\Model;

class Category extends Model
{
	use \app\admin\traits\Tree;

	public function getCategoryList()
	{
		$data = $this->order("sort desc")->select();
		$data = $this->buildMenuLevel($data);
        $data = $this->buildMenuTree($data);
		return $data;
	}
}