<?php

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Upload as UploadModel;
use app\lib\exception\BaseException;

class Upload extends BaseController
{
	protected $beforeActionList = [
       'checkPrimaryScope' => ['except' => '']
    ];

    public function upload(){
       // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // var_dump($file);
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            // $info = $file->validate(['size'=>5*1024*1024,'ext'=>'jpg,png,gif'])->move('..\public\uploads');
            // linux使用绝对路径
            $info = $file->validate(['size'=>5*1024*1024,'ext'=>'jpg,png,gif'])->move('uploads');
            if($info){
                $data['file_url']=str_replace("\\","/","\\uploads\\".$info->getSaveName());
                return $this->res($data,"上传文件成功!");
            }else{
                // 上传失败获取错误信息
                throw new BaseException(
                [
                    'msg' => $file->getError(),
                    'errorCode'=>1
                ]);
            }
        }
    }
}