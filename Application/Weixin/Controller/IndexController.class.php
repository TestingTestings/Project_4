<?php
namespace Weixin\Controller;

use Think\Controller;
use Think\Controller\RestController;
use Weixin\Common\Captcha;


class IndexController extends RestController
{

    protected $allowMethod = ['get', 'post', 'put', 'delete'];
    protected $allowType = ['html', 'json', 'png'];
    protected $defaultMethod = 'get';
    protected $defaultType = 'json';


//    判断用户名是否存在
    public function userExist_get_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问

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
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问

//        将表单数据插入数据库
//        todo 再次验证手机号是否重复
        $data['phone'] = I('post.phone');
        $data['password'] = md5(I('post.password2'));
        $data['idcard'] = I('post.id_number');
        $data['regtime'] = date('Y-m-d');
//
        $User = M('user');
        $User->data($data)->add();


        $this->response($data, 'json');

        // todo 添加到查询历史中
    }


//    生成验证码图片
    public function captcha_get_png()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问

//          TP 验证码
//        $config = [
//            'fontSize' => 50,
//            'length' => 4,
//            'useNoise' => true
//        ];
//        $Verify = new \Think\Verify($config);
//        $Verify->entry();

//        PR 验证码

        $captcha = new Captcha();
        $captcha->create();
        session('captcha', $captcha->__tostring());
    }


//    判断用户登录数据
    public function userLogin_put_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE"); // 允许的跨域请求方式
//
        $request['phone'] = I('phone');
        $request['password'] = md5(I('password'));

        $data['phone'] = $request['phone'];
        $data['password'] = M('user')->where($data)->getField('password');

        $response['isConfirm'] = 0;

        if (strtoupper(I('captcha')) != session('captcha')) { // 验证码校验
            $response['info'] = '验证码错误';
        } elseif (!$data['password']) { // 考虑账号不存在的情况
            $response['info'] = '账号不存在';
        } elseif ($request['password'] != $data['password']) {
            $response['info'] = '密码错误';
        } elseif ($request['password'] == $data['password']) { // 登录成功
            $response['info'] = '登录成功';
            $response['isConfirm'] = 1;
            cookie('userOnline', $request['phone'], 3600 * 5);
        } else {
            $response['info'] = '未知错误';
        }

        // todo 重置验证码 session 值 避免返回重复利用 用随机值覆盖
        session('captcha', 'you_never_guess');


//        $response['password2'] = md5(I('password'));
//        $response['password'] = $data['password'];
//        $response['captcha'] = I('captcha');

        $this->response($response, 'json');
    }


//    todo 用户查询违法车辆
    function carInfo_get_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问

        $request['id'] = strtoupper(I('id'));
        $request['captcha'] = I('captcha');
        $request['vin'] = I('vin');
        $request['type'] = I('type');

        $data['id'] = $request['id'];
        $data['vin'] = $request['vin'];

        $response['car'] = M('car')->where($data)->select()[0];


        if (strtoupper($request['captcha']) != session('captcha')) { // 验证码校验
            $response['isConfirm'] = 0;
            $response['info'] = '验证码错误';
        } elseif (count($response['car']) == 0) { // 车架号匹配
            $response['isConfirm'] = 0;
            $response['info'] = '车牌号与车架号不匹配';
        } else { // todo 返回数据

            // todo 查询相对应的违法记录

            $data = [];
            $data['car_id'] = $request['id'];

//            $response['result'] =  M('case')->where($data)->select();
            $response['result'] = M('case')->select();

            $response['isConfirm'] = 1;
            $response['info'] = '正在查询';
        }

        $this->response($response, 'json');
    }


//    todo 用户查询历史
    function searchHistory_get_json()
    {

    }


    function test()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问
        $request['captcha'] = session('captcha');

        $this->response($request, 'json');
    }


//    验证码校验
    private function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }


    /*
    ！微信接入类 WeiXin TP 自带
          查询 TP 文档
    ！生成微信菜单
        信息

    数据库初始化

    登陆 / 注册
      短信接口
    违章处理
    违章处理 缴费 / 处理 / 申述
    个人信息
    *新闻读取
    *法规查询

    验证码校验
    */

}