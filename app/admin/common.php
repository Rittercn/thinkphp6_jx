<?php
// 这是系统自动生成的公共文件
use Firebase\JWT\JWT;


function getToken($userData=[]){
    $key='!@#$%*&';
    $token=[
        "iss"=>$key,
        "aud"=>'',
        "iat"=>time(),
        "nbf"=>time()+3,
        "exp"=> time()+7200,
        "data"=>[
            'user'=>$userData,
        ]
    ];
    //  print_r($token);
    $jwt = JWT::encode($token, $key, "HS256");  //根据参数生成了 token
    return $jwt;
}

function checkToken($token){
        $key='!@#$%*&';
        $status=["code"=>2];
        try {
            JWT::$leeway = 60;
            $decoded = JWT::decode($token, $key, array('HS256'));
            $arr = (array)$decoded;
            $res['code']=1;
            $res['data']=$arr['data'];
            return $res;

        } catch(\Firebase\JWT\SignatureInvalidException $e) {
            $status['msg']="签名不正确";
            return $status;
        }catch(\Firebase\JWT\BeforeValidException $e) {
            $status['msg']="token失效";
            return $status;
        }catch(\Firebase\JWT\ExpiredException $e) {
            $status['msg']="token失效";
            return $status;
        }catch(Exception $e) {
            $status['msg']="未知错误";
            return $status;
        }
}


/**
 * 成功返回信息
 * status：状态码
 * msg：错误信息
 * data：返回数据
 */
function sucessMsg($msg ='',$data = [])
{
    return json([
        'code' => 200,
        'msg' => $msg,
        'data' => $data
    ], 200);
}

/**
 * 失败返回信息
 * status：状态码
 * msg：错误信息
 * data：返回数据
 */
function errMsg($msg ='',$data = [])
{
    return json([
        'code' => 500,
        'msg' => $msg,
        'data' => $data
    ], 200);
}