<?php
namespace app\admin\controller;

use app\common\controller\Admin;
use think\facade\Env;
use aliyun\AliOss;
use think\facade\Config;

class Upload extends Admin
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    public function upload()
    {
        $systemConfig = $this->sysConfig();
        $aliConfig    = Config::get('app.aliyun');
        $uploadConfig = Config::get('app.upload');

        $file        = $this->request->file('file');
        $uploadPath  = str_replace('\\', '/', Env::get('root_path') . 'public/upload');
        $savePath    = '/upload/';
        $info        = $file->validate($uploadConfig)->move($uploadPath);

        if ($info) {
        
            $url = $savePath . $info->getSaveName();
            $url = str_replace('\\', '/', $url);
            $pathName = str_replace('\\', '/', $info->getPathName());

            if ($systemConfig['is_oss']) {
                $oss = new AliOss(
                    $aliConfig['access_key_id'],
                    $aliConfig['access_key_secret'],
                    $aliConfig['endpoint'],
                    $aliConfig['bucket']
                );
                $result = $oss->uploadFile($info->getFilename(), $pathName);
                
                if ($result) {
                    $url = $result['info']['url'];
                } else {
                    $this->error('上传失败');
                }
            }
            $this->success('上传成功', $url);
        }

        $this->error($file->getError());
    }
}