<?php
declare (strict_types = 1);

namespace app\admin\controller;
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


    public function add(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $data = [
            'name' => $request['data']['name'],
            'img' => $request['url'],
        ];
        $add = Db::name('brand')->save($data);
        if($add == null){
            return errMsg('查询失败');
        }else{
            return sucessMsg('提交成功',$add);
        }
    }

    public function info(Request $request)
    {
        $request =  $request->param();
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $info = Db::name('brand')->where('id',$request['id'])->find();
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }

    public function upd(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $data = [
            'name' => $request['data']['name'],
            'img' => $request['url'],
        ];
        $add = Db::name('brand')->where('id',$request['data']['id'])->save($data);
        if($add == null){
            return errMsg('查询失败');
        }else{
            return sucessMsg('提交成功',$add);
        }
    }

    public function del(Request $request)
    {
        $request =  $request->param();
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $info = Db::name('brand')->where('id', $request['id'])->delete();
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }
}