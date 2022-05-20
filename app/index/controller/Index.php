<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\BaseController;
use think\facade\Db;
use app\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Index
{
    public function index()
    {
       
    }

    public function wxlogin(Request $request)
    {
        $client = new Client();
        $data =  $request->param();  
        $appid = 'wxb7b3c7cd7569a037';//中一
        $SECRET = '3d72302f4488077a5978a4c292493d40';//中一
        
        $response = $client->get('https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$SECRET.'&js_code='.$data['code'].'&grant_type=authorization_code');
        $body = $response->getBody();
        $html = $body->getContents();
        // return json($html);
        echo $html;
    }

    public function wxuserinfo(Request $request)
    {
        $data =  $request->param();  
        if($data){
            $serach = Db::name('user')->where('openid',$data['openid'])->find();
            if($serach){
                return sucessMsg('成功',$serach);
            }else{
                $add = Db::name('user')->save($data);
            }
        }else{
            return errMsg();
        }
        
    }

    public function banner()
    {
        $serach = Db::name('banner')->where('type',1)->select();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('数据为空');
        }
    }

    public function services()
    {
        $serach = Db::name('services')->select();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('数据为空');
        }
    }

    public function indexlist()
    {
        $serach = Db::name('case')->where('category_id',6)->select();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('数据为空');
        }
    }

    public function indexnew()
    {
        $serach = Db::name('case')->where('category_id',5)->select();
        if($serach){
            return sucessMsg('成功',$serach);
        }else{
            return errMsg('数据为空');
        }
    }

    public function casebanner()
    {
        $bannerinfo = Db::name('case_banner')->alias('a')->join('case b','a.cid=b.id')->where('a.id', 1)->find();
        if($bannerinfo == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$bannerinfo);
        }
    }

    public function pcbanner()
    {
        $bannerinfo = Db::name('pcbanner')->select();
        if($bannerinfo == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$bannerinfo);
        }
    }

    public function cbanner()
    {
        $bannerinfo = Db::name('cbanner')->select();
        if($bannerinfo == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$bannerinfo);
        }
    }

    public function tbanner()
    {
        $bannerinfo = Db::name('tbanner')->select();
        if($bannerinfo == null){
            return errMsg('未查到相关信息');
        }else{
            return sucessMsg('成功',$bannerinfo);
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

    public function indexadv()
    {
        $info = Db::name('index_img')->select();
        if($info == null){
            return errMsg('失败');
        }else{
            return sucessMsg('成功',$info);
        }
    }
}
