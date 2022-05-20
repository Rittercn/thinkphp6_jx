<?php
declare (strict_types = 1);

namespace app\admin\controller;
use phpu\facade\ThinkCaptcha;
use think\facade\Db;
use app\Request;

class entrust
{
    public function index(Request $request)
    {
        $request =  $request->param(); 
        if($request['data']){
            $list = Db::name('entrust')->alias('a')->join('entrust_name b','a.c_type=b.id')->field('a.*,b.h_name')->where('c_type', $request['data'])->select();
        }else{
            $list = Db::name('entrust')->alias('a')->join('entrust_name b','a.c_type=b.id')->field('a.*,b.h_name')->select();
        }
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
            'c_name' => $request['data']['c_name'],
            'c_type' => $request['data']['c_type'],
        ];
        $add = Db::name('entrust')->save($data);
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
        $info = Db::name('entrust')->where('id', $request['id'])->find();
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
            'c_name' => $request['data']['c_name'],
            'c_type' => $request['data']['c_type'],
        ];
        $info = Db::name('entrust')->where('id', $request['data']['id'])->save($data);
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('修改成功',$info);
        }
    }

    public function del(Request $request)
    {
        $request =  $request->param();
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $info = Db::name('entrust')->where('id', $request['id'])->delete();
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }

    public function list(Request $request)
    {
        $info = Db::name('entrust_name')->select();
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }


    public function licontent(Request $request)
    {
        $request =  $request->param();
        if($request['data'] == null){
            $info = Db::name('entrust_list')->order('id', 'desc')->paginate([
                'list_rows'=> $request['pagesize'],
                'page' => $request['page'],
            ]);
        }else{
            // $info = Db::name('entrust_list')->where('status', $request['data'])->select();
            $info = Db::name('entrust_list')->where('status', $request['data'])->order('id', 'desc')->paginate([
                'list_rows'=> $request['pagesize'],
                'page' => $request['page'],
            ]);
        }
        
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }

    public function lientrust(Request $request)
    {
        $request =  $request->param();
        if($request['data'] == null){
            return errMsg('未查到相关信息');
        }
        $info = Db::name('entrust_list')->where('id', $request['id'])->save(['status' => $request['data']]);
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功');
        }
    }

    public function opinion(Request $request)
    {
        $request =  $request->param();
        $info = Db::name('opinion')->order('id', 'desc')->paginate([
            'list_rows'=> $request['pagesize'],
            'page' => $request['page'],
        ]);
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }
}