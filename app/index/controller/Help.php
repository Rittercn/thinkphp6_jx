<?php
declare (strict_types = 1);

namespace app\index\controller;
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

    public function opinion(Request $request)
    { 
        $request =  $request->param();   
        if($request == null){
            return errMsg('未获取有用信息');
        }
        // 1是手机
        // 2是pc
        if($request['data']['id'] == 1){
            $data = [
                'name' => $request['data']['name'],
                'content' => $request['data']['content'],
            ];
        }else{
            $data = [
                'name' => $request['data']['name'],
                'phone' => $request['data']['phone'],
                'wx' => $request['data']['wx'],
                'email' => $request['data']['email'],
                'content' => $request['data']['content'],
            ];
        }
        

        $add = Db::name('opinion')->save($data);
        if($add == null){
            return errMsg('提交失败');
        }else{
            return sucessMsg('提交成功',$add);
        }
    }


}