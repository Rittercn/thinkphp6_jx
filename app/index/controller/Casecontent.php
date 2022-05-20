<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\BaseController;
use think\facade\Db;
use app\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class casecontent
{
    public function index(Request $request)
    {
        
        $data =  $request->param();  
        if($data['id'] == 0){
            $serach = Db::name('case')->where('category_id','<>',0)->where('category_id','<>',5)->where('category_id','<>',7)->where('category_id','<>',8)->where('category_id','<>',9)->where('type',1)->order('id', 'desc')->select();
        }else{
            $serach = Db::name('case')->where('category_id',$data['id'])->where('type',1)->order('id', 'desc')->select();
        }
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('数据为空');
        }
    }

   
    public function content(Request $request)
    {
        $data =  $request->param();  
        if($data['id'] == null){
            return errMsg('查询错误');
        }
        $serach = Db::name('case')->where('id',$data['id'])->find();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('错误');
        }
    }

    public function collect(Request $request)
    {
        $data =  $request->param();  
        if($data == null){
            return errMsg('查询错误');
        }
        // $serach = Db::name('collect_id')
        $serach = Db::name('collect_id')->where([
            'cid' => $data['cid'],
            'uid' => $data['uid']
        ])->find();
        if($serach){
            return sucessMsg('您已收藏');
        }else{
            $addcase = Db::name('case')->where('id', $data['cid'])->inc('collect_num')->update();
            $addcollect = Db::name('collect_id')->save($data);
            if($addcollect){
                return sucessMsg('收藏成功');
            }else{
                return errMsg('错误');
            }
        }
    }

    public function peck_num(Request $request)
    {
        $data =  $request->param();  
        if($data == null){
            return errMsg('查询错误');
        }
        // $serach = Db::name('collect_id')
        $serach = Db::name('pecknum')->where([
            'cid' => $data['cid'],
            'uid' => $data['uid']
        ])->find();
        if($serach){
            return sucessMsg('您已点赞');
        }else{
            $addcase = Db::name('case')->where('id', $data['cid'])->inc('peck_num')->update();
            $addcollect = Db::name('pecknum')->save($data);
            if($addcollect){
                return sucessMsg('点赞成功');
            }else{
                return errMsg('错误');
            }
        }
    }

    public function click_num(Request $request)
    {
        $data =  $request->param();  
        if($data == null){
            return errMsg('查询错误');
        }
        // $serach = Db::name('collect_id')
        $serach = Db::name('clicknum_id')->where([
            'cid' => $data['cid'],
            'uid' => $data['uid']
        ])->find();
        if($serach){
            return sucessMsg('您已浏览');
        }else{
            $addcase = Db::name('case')->where('id', $data['cid'])->inc('click_num')->update();
            $addcollect = Db::name('clicknum_id')->save($data);
            if($addcollect){
                return sucessMsg('浏览成功');
            }else{
                return errMsg('错误');
            }
        }
    }
    

    public function case(Request $request)
    {
        $data =  $request->param();  
        if($data){
            $serach = Db::name('case')->where('category_id',$data['id'])->order('id', 'desc')->paginate([
                'list_rows'=> 4,
                'page' => $data['page'],
            ]);          
        }else{
            $serach = Db::name('case')->where('category_id','<>',0)->where('category_id','<>',5)->where('category_id','<>',7)->where('category_id','<>',8)->where('category_id','<>',9)->where('type',1)->order('id', 'desc')->paginate(2);
        }
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('数据为空');
        }
    }
    
}