<?php
declare (strict_types = 1);

namespace app\admin\controller;
use phpu\facade\ThinkCaptcha;
use think\facade\Db;
use app\Request;

class login
{
    public function index(Request $request)
    {
        $data =  $request->param();   
        
        if (false === ThinkCaptcha::check($data['code'])){
            return errMsg('验证码错误');
        }else{
            $user = Db::name('admin_user')->where([
                'username'	=>	$data['username'],
                'password'=> md5($data['password'])
            ])->find();
            if($user){
                $res = [
                    'code' => 200,
                    'res' => '登陆成功',
                    'token' => getToken($user),
                ];
                return json($res);
            }else{
                return errMsg('账号密码不符合');
            }
            
        }
    }

    public function code()
    {
        // base64_encode
        return ThinkCaptcha::configure('sign')->printBase64();
    }
}
