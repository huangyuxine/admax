<?php

namespace aliyun;

use OSS\OssClient;
use think\Config;
use OSS\Core\OssException;


class AliOss
{
	private $accessKeyId;
	private $accessKeySecret;
	private $endpoint;
	private $bucket;

	public function __construct($accessKeyId, $accessKeySecret, $endpoint ,$bucket)
	{
		$this->accessKeyId 		= $accessKeyId;
		$this->accessKeySecret  = $accessKeySecret;
		$this->endpoint 		= $endpoint;
		$this->bucket 			= $bucket;
	}

	public function uploadFile($target, $local)
	{
		$ossClient = new \OSS\OssClient(
			$this->accessKeyId, 
			$this->accessKeySecret, 
			$this->endpoint
		);
		$result = $ossClient->uploadFile(
			$this->bucket, 
			$target, 
			$local
		);

		return $result;
	}
}