<?php
declare (strict_types = 1);

namespace app\admin\controller;
use phpu\facade\ThinkCaptcha;
use think\facade\Db;
use app\Request;


class Index
{
    public function index()
    {
        return '别乱看';
    }
    
    public function banner(Request $request)
    {
        $list = Db::name('banner')->order('id', 'desc')->select();
        if($list == null){
            return errMsg('数据为空');
        }else{
            return sucessMsg('查询成功',$list);
        }
    }

    public function bannerdel(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            $res = ['code' => 400,'res' => '未获取有用信息'];
            return json($res);
        }
        $del = Db::name('banner')->where('id', $request['id'])->delete();
        if($del == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('删除成功',$del);
        }
    }

    public function banneradd(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            $res = ['code' => 400,'res' => '未获取有用信息'];
            return json($res);
        }
        $data = [
            'url' => $request['imageUrl'],
            'name' => $request['data']['name'],
            'type' => $request['data']['type'],
        ];
        $add = Db::name('banner')->save($data);
        if($add == null){
            $res = ['code' => 400,'res' => '提交失败'];
            return json($res);
        }else{
            $res = [
                'code' => 200,
                'res' => '提交成功',
            ];
            return json($res);
        }
    }


    public function bannerupd(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            $res = ['code' => 400,'res' => '未获取有用信息'];
            return json($res);
        }
        $data = [
            'url' => $request['imageUrl'],
            'name' => $request['data']['name'],
            'type' => $request['data']['type'],
        ];
        $add = Db::name('banner')->where('id', $request['data']['id'])->save($data);
        if($add == null){
            $res = ['code' => 400,'res' => '修改失败'];
            return json($res);
        }else{
            $res = [
                'code' => 200,
                'res' => '修改成功',
            ];
            return json($res);
        }
    }

    public function bannerid(Request $request)
    {
        $request =  $request->param();
        if($request == null){
            $res = ['code' => 400,'res' => '未获取有用信息'];
            return json($res);
        }
        $bannerinfo = Db::name('banner')->where('id', $request['id'])->find();
        if($bannerinfo == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$bannerinfo);
        }
    }

    public function bannertype(Request $request)
    {
        $request =  $request->param();
        if($request == null){
            $res = ['code' => 400,'res' => '未获取id'];
            return json($res);
        }
        $bannerinfo = Db::name('banner')->where('id', $request['id'])->save();
        if($bannerinfo == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$bannerinfo);
        }
    }


    public function casebanner()
    {
        $bannerinfo = Db::name('case_banner')->where('id', 1)->find();
       
        if($bannerinfo == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$bannerinfo);
        }
    }

    public function upcasebanner(Request $request)
    {
        $request =  $request->param();
        
        if($request == null){
            return errMsg('未查到相关信息');
        }
        $bannerinfo = Db::name('case_banner')->where('id', 1)->save(['url' => $request['data'],'cid' => $request['activityid']]);
        if($bannerinfo == null){
            return errMsg('未查到相关信息1');
        }else{
            return sucessMsg('成功');
        }
    }

    public function navigation(Request $request)
    {
        $bannerinfo = Db::name('navigation')->select();
        if($bannerinfo == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$bannerinfo);
        }
    }

    public function navid(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $add = Db::name('navigation')->where('id', $request['id'])->find();
        if($add == null){
            return errMsg('查询失败');
        }else{
            return sucessMsg('查询成功',$add);
        }
    }

    public function navadd(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $data = [
            'url' => $request['icon'],
            'name' => $request['data']['name'],
            'cid' => $request['data']['category'],
        ];
        $add = Db::name('navigation')->save($data);
        if($add == null){
            return errMsg('添加失败');
        }else{
            return sucessMsg('添加成功');
        }
    }

    public function navupd(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $data = [
            'url' => $request['icon'],
            'name' => $request['data']['name'],
            'cid' => $request['data']['category'],
        ];
        $add = Db::name('navigation')->where('id', $request['data']['id'])->save($data);
        if($add == null){
            return errMsg('添加失败');
        }else{
            return sucessMsg('添加成功');
        }
    }
    

    public function indexadv()
    {
        $info = Db::name('index_img')->select();
        if($info == null){
            return errMsg('失败');
        }else{
            return sucessMsg('成功',$info);
        }
    }

    public function indexadvupd(Request $request)
    {
        $request =  $request->param();   
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $data = [
            'url' => $request['url'],
            'cid' => $request['cid'],
            'type' => $request['type'],
            'is_gz' => $request['is_gz'],
            'gz_url' => $request['gz_url'],
            'c_name' => $request['c_name'],
        ];
        $add = Db::name('index_img')->where('id', $request['id'])->save($data);
        if($add == null){
            return errMsg('修改失败');
        }else{
            return sucessMsg('修改成功');
        }
    }

    // public function indexadvupd2(Request $request)
    // {
    //     $request =  $request->param();   
    //     if($request == null){
    //         return errMsg('未获取有用信息');
    //     }
    //     $data = [
    //         'url' => $request['url'],
    //         'cid' => $request['cid'],
    //     ];
    //     $add = Db::name('index_img')->where('id', $request['id'])->save($data);
    //     if($add == null){
    //         return errMsg('修改失败');
    //     }else{
    //         return sucessMsg('修改成功');
    //     }
    // }


    

    public function indexcase()
    {
        $info = Db::name('case')->select();
        if($info == null){
            return errMsg('失败');
        }else{
            return sucessMsg('成功',$info);
        }
    }

    public function indexcategory()
    {
        $info = Db::name('category')->select();
        if($info == null){
            return errMsg('失败');
        }else{
            return sucessMsg('成功',$info);
        }
    }
    
    

}
