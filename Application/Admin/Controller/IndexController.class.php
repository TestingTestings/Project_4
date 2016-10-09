<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //拦截器 拦截非法登录
    public function _initialize(){
        $url=$_SERVER['REQUEST_URI'];
        cookie('url',$url);
//        if(substr($url, -5)!='login')
//        {
//            if(session('user')==null)
//            {
//                $this->error('请登录');
//            }
//        }
    }
    //登录界面
    public function index(){

        $this->display();
    }
    //登录判断
    public function login($username,$psd,$code){
        $user=M('admin');//查询管理员表
        $res=$user->where("name='{$username}'")->find();
        if(check_verify($code))
        {
            if($res['password']==md5($psd))
            {
                session('user',$username);//创建session作为登录凭据
                $this->success('登陆成功','welcome',1);
            }
            else{
                $this->error('登陆失败,账号或密码错误');//正确与错误的跳转
            }
        }
        else
        {
            $this->error('登陆失败,验证码错误');//正确与错误的跳转
        }
    }
    //主界面
    public function welcome(){
        //读取菜单表
        $title=M('menu');
        $menu=$title->select();
        $this->assign('menu',$menu);
        //读取用户名
        $this->assign('user',session('user'));
        $this->display('welcome');
    }
    //警员管理
    public function police(){
        $this->search('police');
    }

    //用户管理入口
    public function user(){
        $this->search('user');
    }
    //搜索模块化
    private function search($sheel,$condition,$num=7){//查询的表，加入的筛选条件
        $search=I('get.search');//获得搜索栏信息
        $police=M($sheel);
        if(!empty($search))
        {
            if(!isset($condition))//判断是否有筛选条件
            {
                $condition['_logic'] = 'and';
            }
            $map=search_where($sheel,$search);//调用搜索函数生成搜索数组
            $count=$police->where($condition)->where($map)->count();//查询条数
            $Page= new \Think\Page($count,$num);//创建分页
            $res= $police->where($map)->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();
            foreach($map as $key=>$val) {//带入搜索值翻页
                $Page->parameter .= "$key=".urlencode($val)."&";
            }
        }else
        {
            if(!isset($condition))
            {
                $condition="";
            }
            $count=$police->where($condition)->count();//查询条数
            $Page= new \Think\Page($count,$num);//创建分页
            $res= $police->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();
        }
        //翻页栏构造
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        $Page->setConfig('header','<p style="display: inline">共<b>%TOTAL_ROW%</b>条记录&nbsp;</p>');
        $show=$Page->show();
        $this->assign("police",$res);
        $this->assign("page",$show);
        $this->assign("search",$search);
        $this->display($sheel);
    }
    //违章管理
    public function peccancy(){

    }
    //验证码
    public function verify(){
        $config =    array(
            'fontSize'    =>    23,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'imageW'      =>    150,
            'imageH'      =>    45,
            'useCurve'    =>    false,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    //登出
    public function loginout(){
        session("user",null);
        echo U('index');
        $this->redirect('index', "",0);

    }
    //添加警员
    public function policeadd(){
        $policeid=M("police")->order('id desc')->limit(1)->select();
        $this->assign("id",$policeid[0]['id']+1);
        if(session("police")!=null)
        {
            $this->assign("police",session("police"));
            session("police",null);
        }
        $this->display("policeadd");
    }
    //添加警员信息详情
    public function detail($id,$password,$policename,$sex,$age,$area,$job,$imei){
        $police['id']=$id;
        $police['password']=$password;
        $police['policename']=$policename;
        $police['sex']=$sex;
        $police['age']=$age;
        $police['area']=$area;
        $police['job']=$job;
        $police['imei']=$imei;
        session("police",$police);
        $this->assign("police",$police);
        $this->display("detail");
    }
    //警员信息写入
    public function policewrite(){
        $police=M("police");
        $data['id']=session("police")['id'];
        $data['name']=session("police")['policename'];
        $data['password']=md5(session("police")['password']);
        $data['sex']=session("police")['sex'];
        $data['area']=session("police")['area'];
        $data['age']=session("police")['age'];
        $data['job']=session("police")['job'];
        $data['imei']=session("police")['imei'];
        $data['state']='normal';
        $police->add($data);
        session("police",null);
        $this->redirect('police');
    }
    //法规
    public function law(){
        $this->search('law','',20);
    }
    //案件查询入口
    public function police_case(){
        $this->search("case");
    }
    //案件处理入口
    public function police_appeal(){
        $this->search('case',"state='申诉'");
    }
    //案件修正
    public function police_change(){
        $this->search('case',"state='修正'");
    }
    //案件详情数据读取
    public function case_detail(){
        $case_id=I('get.id');
        $detail=M('case');
        $one_case=$detail->where("id='{$case_id}'")->select();
        $police_id=$one_case[0]['police_id'];
        $car_id=$one_case[0]['car_id'];
        $police=M('police');
        $car=M('car');
        $one_police=$police->where("id={$police_id}")->select();
        $one_car=$car->where("id='{$car_id}'")->select();

        $this->assign('detail',$one_case[0]);
        session("case_detail",$one_case[0]);
        $this->assign('police',$one_police[0]);
        $this->assign('car',$one_car[0]);
        $this->display();
    }
    //案件处理
    public function case_appeal(){
        $case_detail=session("case_detail");
        session("case_detail",'');
        $id=$case_detail['id'];
        $this->assign("case_detail",$case_detail);
        $casehandle=M('casehandle');
        $res=$casehandle->where("case_id=$id and state2='未处理'")->select();
        $this->assign("content",$res);
        $this->display('case_appeal');
    }
    //案件写入
    public function case_deal($id,$content,$punishment,$cost,$appeal,$detail_id){
        $case = M("case");
        $handle=M("casehandle");
        $case->startTrans();
        if($appeal=='change') {
            $case->content = $content;
            $case->punishment = $punishment;
            $case->cost = $cost;
            $case->state='未处理';
        }
        else if($appeal=='no'){
            $case->state='未处理';
        }
        else if($appeal=='ok'){
            $case->state='销毁';
        }
        $handle->state2='已处理';
        $handle->handletime=date('Y-m-d  H:i:s',time());
        $res1=$case->where("id=$id")->save();
        $res2=$handle->where("id=$detail_id")->save();
        if($res1 && $res2){
            $case->commit();//成功则提交
            $this->success('处理成功','police_case',1);
        }else{
            $case->rollback();//不成功，则回滚
        }
    }

}
//验证码生成
function check_verify($code){
    $verify = new \Think\Verify();
    return $verify->check($code);
}
//搜索函数构造索引数组
function search_where($sheel,$search){
    if($sheel=='police') {
        $where['id'] = array('like', '%' . $search . '%');
        $where['name'] = array('like', '%' . $search . '%');
        $where['age'] = array('like', '%' . $search . '%');
        $where['area'] = array('like', '%' . $search . '%');
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
    }else if($sheel=='case')
    {
        $where['id'] = array('like', '%' . $search . '%');
        $where['content'] = array('like', '%'.$search . '%');
        $where['place'] = array('like', '%' . $search . '%');
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
    }
    else if($sheel=='user')
    {
        $where['id'] = array('like', '%' . $search . '%');
        $where['name'] = array('like', '%'.$search . '%');
        $where['idcard'] = array('like', '%' . $search . '%');
        $where['phone'] = array('like', '%' . $search . '%');
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
    }
    return $map;
}
?>