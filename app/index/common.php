<?php
// 这是系统自动生成的公共文件

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