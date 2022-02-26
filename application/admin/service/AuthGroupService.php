<?php
namespace app\admin\service;

use app\admin\model\AuthMenu;
use think\Db;
use app\admin\service\MenuService;
use app\admin\model\AuthMenu as AuthMenuModel;
use app\admin\model\AuthGroup as AuthGroupModel;

class AuthGroupService
{

    public function authMenu(int $id = 0)
    {
        $menuService = new MenuService();
        $list = (new AuthMenuModel())->getMenuList();
        if ($id) {
            $rules = (new AuthGroupModel())->where(['id' => $id])->value('rules');
            $rules = explode(',', $rules);
            foreach ($list as $key => $value) {
                $menu = (new AuthMenuModel())->where(['pid' => $value['id']])->find();
                foreach ($rules as $k => $v) {
                    if ($value['id'] == $v && !$menu) {
                        $list[$key]['checked'] = true;
                    }
                }
            }
        }

        $list = $menuService->buildMenuChild($list);
        return $list;
    }

}
