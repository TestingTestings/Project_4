<?php
namespace Weixin\Controller;

use Think\Controller;
use Think\Controller\RestController;
use Think\Model;
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


//    增加一条用户数据
    public function userData_post_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问

//        将表单数据插入数据库
//        todo-5 再次验证手机号是否重复
        $data['phone'] = I('post.phone');
        $data['password'] = md5(I('post.password2'));
        $data['idcard'] = I('post.id_number');
        $data['regtime'] = date('Y-m-d');
//
        $User = M('user');
        $User->data($data)->add();


        $this->response($data, 'json');

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

        // 重置验证码 session 值 避免返回重复利用 用随机值覆盖
        session('captcha', 'you_never_guess');


//        $response['password2'] = md5(I('password'));
//        $response['password'] = $data['password'];
//        $response['captcha'] = I('captcha');

        $this->response($response, 'json');
    }


//    用户查询违法车辆
    function carInfo_get_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问

        $request['id'] = strtoupper(I('id'));
        $request['captcha'] = I('captcha');
        $request['vin'] = I('vin');
        $request['type'] = I('type');

        $data['id'] = $request['id'];
        $data['vin'] = $request['vin'];

        $response['car'] = M('car')->where($data)->select();

        if (strtoupper($request['captcha']) != session('captcha')) { // 验证码校验

            $response['isConfirm'] = 0;
            $response['info'] = '验证码错误';

        } elseif (count($response['car']) == 0) { // 车架号匹配

            $response['isConfirm'] = 0;
            $response['info'] = '车牌号与车架号不匹配';

        } else { // 返回数据

            // 重置验证码
            session('captcha', 'you_never_guess');

            // 查询相对应的违法记录
            $data = [];
            $data['car_id'] = $request['id'];

            // 多表查询 警员信息 法律法规
            // todo-5 ->field()
            $Model = new Model(); // todo-11 修正和銷毀增加查詢限制
            $sql = "select a.*, b.name as police_name, b.job as police_job, b.area, c.content  as law_content, c.strip  as law_title, d.type, e.name from t_case as a, t_police as b, t_law as c, t_car as d, t_user as e where e.drive_card=a.drive_card and d.id=a.car_id and a.state <> '修正' and a.state <> '销毁' and a.state <> '审核' and a.police_id=b.id and c.id=a.law_id and a.car_id='" . $data['car_id'] . "'";
            $response['result'] = $Model->query($sql);
            $response['isConfirm'] = 1;
            $response['info'] = '正在查询';

            // 添加到查询历史
            // todo-5 拆分成方法
            if (I('user') != 0) {
                // 新建查询历史表

                if (count(M('history')->where($data)->select()) == 0) {
                    $data = [];
                    $data['car_id'] = $request['id'];
                    $data['user'] = I('user');
                    M('history')->data($data)->add();

                } else { // 已有查询时只更新查询时间

                    $data = [];
                    $data['car_id'] = $request['id'];
                    $data['user'] = I('user');
                    $update = [];
                    $update['time'] = date('Y-m-d H:i:s', time());
                    M('history')->where($data)->data($update)->save();
                }
            }
        }

        $this->response($response, 'json');
    }


//    用户申诉
    function complaint_post_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE"); // 允许的跨域请求方式

        $Casehandle = M('casehandle');


        $data['case_id'] = I('case_id');
//        $response['state'] = $Casehandle->field('state')->where($data)->select()[0]['state']; // 处理状态查询

//        if ($response['state'] == '申诉') {  // todo-1 重复申诉
        if (0) {  // todo-1 重复申诉
            $response['info'] = '不能对已申诉案件重复申诉';
            $response['isConfirm'] = 0;
        } elseif (!I('content')) { // 内容不为空
            $response['info'] = '申诉内容不能为空';
            $response['isConfirm'] = 0;
        } elseif ($data['case_id']) {


            // 插入申述内容
            $data['case_id'] = I('case_id');
            $data['content'] = I('content');
            $data['state'] = '申诉';
            $data['happentime'] = date('Y-m-d H:i:s', time());
            $Casehandle->data($data)->add();


            // t_casehandle 表的 case_id 外键会使次处失效 原因：表引擎不同 myisam innordb
            // 修改正表的状态 使用触发器 todo-6 在phpstorm 中执行 DDL
            // 修改case表状态为申诉
            $update['state'] ='申诉';
            $where['id'] = I('case_id');
            M('case')->where($where)->data($update)->save();

//            $Model = new Model();
//            $sql = "update t_case set state='申诉' where id=" . I('case_id');
//            $Model->query($sql);

            $response['isConfirm'] = 1;
        } else {
            $response['info'] = '未知错误';
            $response['isConfirm'] = 0;
        }

        $this->response($response, 'json');
    }


//    用户查询历史
    function searchHistory_get_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE"); // 允许的跨域请求方式

//        $data = [];
//        $data['user'] = I('user');
//        $rs['history'] = M('history')->where($data)->select();

        $Model = new Model();
        $sql = "select a.*, b.vin from t_history as a, t_car as b where a.user=" . I('user') . " and a.car_id=b.id";
        $rs['history'] = $Model->query($sql);


        $this->response($rs, 'json');
    }


//    用户查询历史跳转结果页面
    function historyInfo_get_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问

        // 查询相对应的违法记录
        $data['car_id'] = strtoupper(I('id'));

        // 多表查询 警员信息 法律法规
        $Model = new Model();
        $sql = "select a.*, b.name as police_name, b.job as police_job, b.area, c.content  as law_content, c.strip  as law_title, d.type, e.name from t_case as a, t_police as b, t_law as c, t_car as d, t_user as e where e.drive_card=a.drive_card and d.id=a.car_id and a.state <> '修正' and a.state <> '销毁' and a.state <> '审核' and a.police_id=b.id and c.id=a.law_id and a.car_id='" . $data['car_id'] . "'";

        $response['result'] = $Model->query($sql);

        $response['isConfirm'] = 1;
        $response['info'] = '正在查询';

        $this->response($response, 'json');
    }


//    todo-2 支付后改变处理状态
    function payment_put_json()
    {

    }


    // 证据
    function evidence_get_json()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE"); // 允许的跨域请求方式

        $data['case_id'] = I('case_id');
        $data['rs'] = M('evidence')->where($data)->select();


        $this->response($data, 'json');


    }


    // todo-1 通过驾驶证号查询违章
    function peopleInfo_get_json(){

        header("Access-Control-Allow-Origin: *"); // 允许跨域访问


        $data['name'] = I('name');
        $data['drive_card'] = I('drive_card');
        $response['user'] = M('user')->where($data)->select();

        if (strtoupper(I('captcha')) != session('captcha')) { // 验证码校验

            $response['isConfirm'] = 0;
            $response['info'] = '验证码错误';

        } elseif (count($response['user']) == 0) { // 车架号匹配

            $response['isConfirm'] = 0;
            $response['info'] = '驾驶证信息不匹配';

        } else { // 返回数据

            // 重置验证码
            session('captcha', 'you_never_guess');

            // 查询相对应的违法记录
            // 多表查询 警员信息 法律法规
            // todo-5 ->field()
            $data['drive_card'] = I('drive_card');
            $Model = new Model(); // todo-11 修正和銷毀增加查詢限制
            $sql = "select a.*, b.name as police_name, b.job as police_job, b.area, c.content  as law_content, c.strip  as law_title, d.type, e.name from t_case as a, t_police as b, t_law as c, t_car as d, t_user as e where e.drive_card=a.drive_card and d.id=a.car_id and a.state <> '修正' and a.state <> '销毁' and a.state <> '审核' and a.police_id=b.id and c.id=a.law_id and a.drive_card=" . $data['drive_card'];
            $response['result'] = $Model->query($sql);
            $response['isConfirm'] = 1;
            $response['info'] = '正在查询';
        }

        $this->response($response, 'json');
    }


    function test()
    {
        header("Access-Control-Allow-Origin: *"); // 允许跨域访问
//        $response['captcha'] = session('captcha');


        $Model = new Model();
        $sql = "select a.*, b.name as police_name, b.job as police_job, b.area, c.content  as law_content, c.strip  as law_title from t_case as a, t_police as b, t_law as c where a.police_id=b.id and c.id=a.law_id and a.car_id='闽A0001'";
        $response['result'] = $Model->query($sql);

        $sql = "select a.*, b.name as police_name, b.job as police_job, b.area, c.content  as law_content, c.strip  as law_title, d.type, e.name from t_case as a, t_police as b, t_law as c, t_car as d, t_user as e where e.drive_card=a.drive_card and d.id=a.car_id and a.state <> '修正' and a.state <> '销毁' and a.state <> '审核' and a.police_id=b.id and c.id=a.law_id and a.drive_card=321875568755";
        $response['result_2'] = $Model->query($sql);

        $this->response($response, 'json');
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