<?php
namespace app\admin\model;
use think\Model;

class AdminUser extends Model
{
    protected $pk = 'id';
    protected $createTime = 'create_time';
	protected $updateTime = 'update_time';
    protected $fields = 'id, username, status, last_login_ip, create_time, last_login_time';

    public function getAdminerList()
    {
        $list = $this->field($this->fields)->select()->toArray();
        $list = array_map(function($val){
            if ($val['last_login_time']) {
               $val['last_login_time'] =  date('Y-m-d H:i', $val['last_login_time']);
            }
            return $val;
        }, $list);

        return $list;
    }
}