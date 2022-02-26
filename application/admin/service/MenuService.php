<?php
namespace app\admin\service;

use app\admin\model\AuthMenu as AuthMenuModel;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AdminUser as AdminUserModel;
class MenuService
{
    public function getMenu()
    {
        $groupId = (new AdminUserModel())->where(['id' => session('admin_id')])->value('group_id');
        $rules = (new AuthGroupModel())->where(['id' => $groupId])->value('rules');
        $where['id'] = explode(',', $rules);
        $where['status'] = 1;
        $menus = (new AuthMenuModel())->getConditionMenus($where);
        // echo Db::table('auth_menu')->getLastSql();
    	$menus = $this->buildMenuType($menus);
    	$menus = $this->buildMenuChild($menus);
    	return $menus;
    }
    /**
     * 子分类
     * @param  [int] $id 
     * @return [array]
     */
    public function getMenuChild($id)
    {
        if (empty($id)) {
            return false;
        }
        $where['pid'] = $id;
        $where['status'] = 1;

        $children = (new AuthMenuModel())->getConditionMenus($where);

        return $children;
    }
    /**
     * 层级转换
     * @param array $array 源数组
     * @return array
    */
	public function buildMenuType($array)
	{
        $list = [];
	    foreach ($array as $v) {
	
            if($this->getMenuChild($v['id'])){
                $v['type'] = 0;
            }else{
                $v['type'] = 1;
            }
            
            $v['openType'] = $v['target'];
            $list[] = $v;
	        
	    }

	    return $list;
	}

    public function buildMenuChild($menus, $pid = 0)
    {
        $treeList = [];
        foreach ($menus as $v) {
            !empty($v['href']) && $v['href'] = url($v['href']);
            if ($pid == $v['pid']) {
                $child = $this->buildMenuChild($menus, $v['id']);
                if (!empty($child)) {
                    $v['children'] = $child;
                }
                if (!empty($v['href']) || !empty($child)) {
                    $treeList[] = $v;
                }
            }
        }
        return $treeList;
    }


}
