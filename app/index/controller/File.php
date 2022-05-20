<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use app\Request;
use think\facade\Filesystem;


class file extends BaseController
{
    public function index()
    {
        $file = request() -> file('file');
        
        if ($file == null) {
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                '未上传图片'
            );
        }
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);

        if(!in_array($extension, array("jpeg","JPEG","jpg","JPG","png","PNG","gif","GIF"))){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                '上传图片不合法'
            );
        }
        $saveName = Filesystem::disk('photo') -> putFile('photo', $file, 'md5');
        $res = [
            'code' => 200,
            'res' => '上传成功',
            'data' => str_replace('\\', '/', '/uploads/' . $saveName),
        ];
        return json($res);
    }

}
