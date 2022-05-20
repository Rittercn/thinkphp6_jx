<?php
namespace app\controller;

namespace app\index\controller;
use phpu\facade\ThinkCaptcha;
use think\facade\Db;
use app\Request;


class User 
{
    public function index()
    {
      
    }

    public function collectinfo(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        $serach = Db::name('collect_id')->alias('a')->join('case b','a.cid=b.id')->where('uid',$data['uid'])->select();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('数据为空');
        }
    }

    public function clicknum(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        $serach = Db::name('collect_id')->alias('a')->join('case b','a.cid=b.id')->where('uid',$data['uid'])->select();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('数据为空');
        }
    }

    public function userhistory(Request $request)
    {
        $data =  $request->param();
        if($data == null){
            return errMsg('查询错误');
        }
        $serach1 = Db::name('clicknum_id')->alias('a')->join('case b','a.cid=b.id')->where('uid',$data['uid'])->whereDay('addtime')->select();
        $serach2 = Db::name('clicknum_id')->alias('a')->join('case b','a.cid=b.id')->where('uid',$data['uid'])->whereDay('addtime','yesterday')->select();
        $redata = [
            'oneday' => $serach1,
            'twoday' => $serach2
        ];
        if($serach1){
            return sucessMsg('成功',$redata);
        }else{
            return errMsg('数据为空');
        }
    }

}
