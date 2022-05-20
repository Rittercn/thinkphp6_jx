<?php
declare (strict_types = 1);

namespace app\admin\controller;
use phpu\facade\ThinkCaptcha;
use think\facade\Db;
use app\Request;

class help
{
    public function index(Request $request)
    { 
        $list = Db::name('help')->alias('a')->join('case b','a.aid=b.id')->select();
        
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
            'aid' => $request['data']['category'],
            'title' => $request['data']['name'],
        ];
        $add = Db::name('help')->save($data);
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
        $info = Db::name('help')->where('bid',$request['bid'])->find();
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
            'aid' => $request['data']['category'],
            'title' => $request['data']['name'],
        ];
        $add = Db::name('help')->where('bid',$request['data']['id'])->save($data);
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
        $info = Db::name('help')->where('id', $request['id'])->delete();
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }
}