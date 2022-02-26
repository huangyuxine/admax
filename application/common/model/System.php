<?php
namespace app\common\model;
use think\Model;

class System extends Model
{
	public function getSystemConfig()
	{
		$data = $this->find();
		$data = json_decode($data['value'], true);
		return $data;
	}
}