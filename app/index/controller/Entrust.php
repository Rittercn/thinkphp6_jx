<?php
namespace app\controller;

namespace app\index\controller;
use phpu\facade\ThinkCaptcha;
use think\facade\Db;
use app\Request;


class Entrust 
{
    public function index(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        $serach = Db::name('entrust_list')->where([
            ['uid','=',$data['uid']],
            ['status','<>','4'],
            ['status','<>','5'],
        ])->select();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('错误');
        }
    }

    public function list(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        $serach = Db::name('entrust_list')->where('uid','=',$data['uid'])->where('status','=','4')->whereOr('status','=','5')->select();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('错误');
        }
    }

    public function option()
    {
        $list = Db::name('entrust')->alias('a')->join('entrust_name b','a.c_type=b.id')->field('a.*,b.h_name')->select();
        if($list == null){
            return errMsg('查询失败');
        }else{
            return sucessMsg('查询成功',$list);
        }
    }

    public function add(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        if($data['data']['name'] == ''){
            return errMsg('请输入您的称呼');
        }
        if($data['data']['sex'] == ''){
            return errMsg('请选择您的性别');
        }
        if($data['data']['phone'] == ''){
            return errMsg('请填写联系电话');
        }
        if($data['data']['columns'] == ''){
            return errMsg('请选择方案类型');
        }
        if($data['data']['columns2'] == ''){
            return errMsg('请选择方案种类');
        }
        if($data['data']['columns3'] == ''){
            return errMsg('请选择活动预算');
        }
        $addinfo = [
            'name' => $data['data']['name'],
            'sex' => $data['data']['sex'],
            'phone' => $data['data']['phone'],
            'remark' => $data['data']['text'],
            
            'type' => $data['data']['columns'],//方案类型
            'category' => $data['data']['columns2'],//方案种类
            'budget' => $data['data']['columns3'],//活动预算

            'uid' => $data['uid'],
            'wxname' => $data['username'],
        ];
        $add = Db::name('entrust_list')->save($addinfo);
        if($add){
            return sucessMsg('成功');
        }else{
            return errMsg('错误');
        }
    }

    public function pcadd(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        $addinfo = [
            'name' => $data['data']['name'],
            'sex' => $data['data']['sex'],
            'phone' => $data['data']['phone'],
            'remark' => $data['data']['text'],
            
            'type' => $data['data']['columns'],//方案类型
            'category' => $data['data']['columns2'],//方案种类
            'budget' => $data['data']['columns3'],//活动预算

            'uid' => '',
            'wxname' => '',
        ];
        $add = Db::name('entrust_list')->save($addinfo);
        if($add){
            return sucessMsg('成功');
        }else{
            return errMsg('错误');
        }
    }


    public function updlist(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        $serach = Db::name('entrust_list')->where('uid','=',$data['uid'])->where('id','=',$data['cid'])->save(['status' => 6]);
        if($serach){
            return sucessMsg('成功');
        }else{
            return errMsg('错误');
        }
    }

    public function info(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        $serach = Db::name('entrust_list')->where('id','=',$data['id'])->find();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('错误');
        }
    }

}
