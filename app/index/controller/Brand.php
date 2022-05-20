<?php
declare (strict_types = 1);

namespace app\index\controller;
use phpu\facade\ThinkCaptcha;
use think\facade\Db;
use app\Request;

class brand
{
    public function index(Request $request)
    { 
        $list = Db::name('brand')->select();
        
        if($list == null){
            return errMsg('查询失败');
        }else{
            return sucessMsg('查询成功',$list);
        }
    }

    public function content(Request $request)
    { 
        $list = Db::name('case')->where('id',8)->find();
        
        if($list == null){
            return errMsg('查询失败');
        }else{
            return sucessMsg('查询成功',$list);
        }
    }
   
}