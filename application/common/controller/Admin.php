<?php
namespace app\common\controller;

use think\Controller;
use think\Db;
use app\admin\service\MenuService;
use app\admin\model\AuthMenu as AuthMenuModel;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AdminUser as AdminUserModel;
use app\common\model\System as SystemModel;

error_reporting(E_ALL & ~E_NOTICE);

class Admin extends Controller
{
	public function initialize()
    {
        parent::initialize();

        
        if (!session('admin_name')) {
            $this->redirect('login/index');
        }
        
        $this->checkAuth();
    }
    /**
     * 初始化菜单
     * @return [json] [menu]
     */
    public function initmenu()
    {
        header('Content-type: application/json');
		$menuService = new MenuService();
        $menus = $menuService->getMenu();
		return json($menus);
    }
    /**
     * 初始化配置
     * @return [json] [config]
     */
    public function initadmin()
    {
    	$adminConfig = config('adminConfig');
    	echo $adminConfig;
    }

    /**
     * 验证权限
     */
    public function checkAuth()
    {
        $groupId = (new AdminUserModel())->where(['id' => session('admin_id')])->value('group_id');
        $rules = (new AuthGroupModel())->where(['id' => $groupId])->value('rules');

        $where['id'] = explode(',', $rules);
        $menus = (new AuthMenuModel())->getConditionMenus($where);
        $href = array_column($menus, 'href');
        $controller = $this->request->controller();
        $action     = $this->request->action();

        $path = build_controller($controller) . '/' . $action;

            // if (!in_array($path, $href)) {
            //     $this->error('没有权限');
            // } 

    }
    /**
     * 系统配置
     */
    public function sysConfig()
    {
        $data = (new SystemModel())->getSystemConfig();
        return $data;
    }
}
