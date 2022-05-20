<?php
declare (strict_types = 1);

namespace app\admin\controller;
use phpu\facade\ThinkCaptcha;
use think\facade\Db;
use app\Request;

class activity
{
    public function index(Request $request)
    {
        $request =  $request->param();   
        
        if($request['categoryid']){
            $list = Db::name('case')->alias('a')->join('category b','a.category_id=b.id')->field('a.*,b.c_name')->where('category_id', $request['categoryid'])->order('id', 'desc')->paginate([
                'list_rows'=> $request['pagesize'],
                'page' => $request['page'],
            ]);
        }else{
            $list = Db::name('case')->alias('a')->join('category b','a.category_id=b.id')->field('a.*,b.c_name')->order('id', 'desc')->paginate([
                'list_rows'=> $request['pagesize'],
                'page' => $request['page'],
            ]);
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
        if($request['data']['category'] == 0){
            return errMsg('请选择分类');
        }
        if($request['data']['category'] == ''){
            return errMsg('请选择分类');
        }
        $data = [
            'name' => $request['data']['name'],
            'des' => $request['data']['des'],
            'img' => $request['imageUrl'],
            'content' => $request['data']['text'],
            
            'tag' => $request['tag'],
            'click_num' => $request['data']['click_num'],
            'collect_num' => $request['data']['collect_num'],
            'peck_num' => $request['data']['peck_num'],
            
            'category_id' => $request['data']['category'],
            'type' => $request['data']['type'],

            'is_gz' => $request['data']['is_gz'],
            'gz_url' => $request['data']['gz_url'],
        ];
        $add = Db::name('case')->save($data);
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
        $info = Db::name('case')->where('id', $request['id'])->find();
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
            'des' => $request['data']['des'],
            'img' => $request['imageUrl'],
            'content' => $request['data']['text'],
            
            'tag' => $request['tag'],
            'click_num' => $request['data']['click_num'],
            'collect_num' => $request['data']['collect_num'],
            'peck_num' => $request['data']['peck_num'],
            
            'category_id' => $request['data']['category'],
            'type' => $request['data']['type'],

            'is_gz' => $request['data']['is_gz'],
            'gz_url' => $request['data']['gz_url'],
        ];
        $info = Db::name('case')->where('id', $request['data']['id'])->save($data);
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }

    public function del(Request $request)
    {
        $request =  $request->param();
        if($request == null){
            return errMsg('未获取有用信息');
        }
        $info = Db::name('case')->where('id', $request['id'])->delete();
        if($info == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$info);
        }
    }
}