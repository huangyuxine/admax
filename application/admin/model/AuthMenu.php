<?php
namespace app\admin\model;
use think\Model;

class AuthMenu extends Model
{
    use \app\admin\traits\Tree;

    protected $pk = 'id';
    protected $createTime = 'create_time';
	protected $updateTime = 'update_time';
    protected $fields = 'id, pid, title, href, target, icon, status, sort';
    public function getMenuList()
    {
        $menus = $this->field($this->fields)->order('sort desc')->select()->toArray();
        return $menus;
    }

    public function getConditionMenus(array $where)
    {
        $menus = $this->field($this->fields)->where($where)->select()->toArray();
        return $menus;
    }

    public function getPidMenuList()
    {
        $menus = $this->getMenuList();
        $menus = $this->buildMenuLevel($menus);
        $menus = $this->buildMenuTree($menus);
        return $menus;
    }


}