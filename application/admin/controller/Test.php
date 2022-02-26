<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use phpmailer\Mailer;
use think\facade\Config;

/**
 * 演示类
 */
class Test extends Admin
{
	private $config;

	public function __construct()
	{
		parent::__construct();
		$this->config = Config::get('app.');
	}

	public function mail()
	{
		$config = ($this->config)['email'];
		$mail = new Mailer(
			$config['name'],
			$config['host'],
			$config['username'],
			$config['password'],
			$config['port']
		);

		$subject = '通知';
		$body = '<strong>通知：×××××××××</strong>';
		$to = 'qqq@qq.com';
		$attch = './upload/20201231/aa88de17f9a626b07e91356f33d8306b.jpg';
		$res = $mail->send($to, $subject, $body, $attch);
		dump($res);
	}
}

