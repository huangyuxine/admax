<?php

namespace phpmailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
	private $name;
	private $host;
	private $username;
	private $password;
	private $port;

	public function __construct($name, $host, $username, $password, $port)
	{
		$this->name     = $name;
		$this->host 	= $host;
		$this->port 	= $port;
		$this->username = $username;
		$this->password = $password;
	}

	/**
	 * 发送邮箱
	 * @param  [type] $replayTo [目标邮箱]
	 * @param  [type] $subject  [标题]
	 * @param  [type] $body     [内容]
	 * @param  [type] $attachment     [附件]
	 * @return [type]           
	 */
	public function send($replayTo, $subject, $body, $attachment = '')
	{
		$mail = $this->setLink();

		$mail->addAddress($replayTo);
		$mail->addAttachment($attachment);
		$mail->isHTML(true);

		$mail->Subject = $subject;
		$mail->Body    = $body;
		$result 	   = $mail->send();

		return $result;

	}

	private function setLink()
	{
		$mail = new PHPMailer(true);  
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->host 	= $this->host;
		$mail->Username = $this->username;
		$mail->Password = $this->password;
		$mail->setFrom($this->username, $this->name);
		return $mail;
	}
}