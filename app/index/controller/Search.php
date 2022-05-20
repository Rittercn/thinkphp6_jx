<?php
declare (strict_types = 1);

namespace app\index\controller;
use app\BaseController;
use think\facade\Db;
use app\Request;

class Search
{
    public function index(Request $request)
    {
        $data =  $request->param();  
        if($data){
            $serach = Db::name('case')->where('name','LIKE','%'.$data['name'].'%')->select();
            if($serach){
                return sucessMsg('成功',$serach);
            }else{
                return errMsg('未查询到相关数据');
            }
        }else{
            return errMsg();
        }
    }

}
