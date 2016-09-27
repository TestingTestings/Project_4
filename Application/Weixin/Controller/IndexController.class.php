<?php
namespace Weixin\Controller;

use Think\Controller;
use Think\Controller\RestController;

class IndexController extends RestController
{

    protected $allowMethod = ['get', 'post', 'put', 'delete'];
    protected $allowType = ['html', 'json'];
    protected $defaultMethod = 'get';
    protected $defaultType = 'html';


//    判断用户名是否存在
    public function userExist_get_json()
    {
//         允许跨域访问
        header("Access-Control-Allow-Origin: *");

        $request['phone'] = I('phone');
        $User = M('user');
        $data = $User->where($request)->select();
        if (count($data) > 0) {
            $this->response(['isExist' => 1], 'json');
        } else {
            $this->response(['isExist' => 0], 'json');
        }
    }

//    增加一条用户信息
    public function userData_post_json()
    {
//         允许跨域访问
        header("Access-Control-Allow-Origin: *");

//        将表单数据插入数据库
//        todo 再次验证手机号是否重复
        $data['phone'] = I('post.phone');
        $data['password'] = md5(I('post.password2'));
        $data['idcard'] = I('post.idcard');
        $data['regtime'] = date('Y-m-d');
        $User = M('user');
        $User->data($data)->add();
        $this->response($data, 'json');
    }

//    修改用户信息


//    ！微信接入类 WeiXin TP 自带
//          查询 TP 文档
//    ！生成微信菜单
//        信息

//    数据库初始化

//    登陆 / 注册
//      短信接口
//    违章处理
//    违章处理 缴费 / 处理 / 申述
//    个人信息
//    *新闻读取
//    *法规查询
}