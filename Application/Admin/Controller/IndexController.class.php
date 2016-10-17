<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //拦截器 拦截非法登录
    public function _initialize(){
        if(session('user')==null)
        {
            $this->error('请先登录！','/project_4/admin/login',3);
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
        $this->assign("power",session('power'));
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
                $condition['_logic'] = 'and';
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
        if(count($res)==0) {
            $this->assign("empty", 0);
        }
        else{
            $this->assign("empty", 1);
        }
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
        $this->redirect('/admin/login/index', "",0);

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
        $this->search('law','',145);
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
        $case_id=I('get.id');//获得案件id
        $detail=M('case');
        $one_case=$detail->where("id='{$case_id}'")->select();//新建案件模型
        //通过案件数据得到警员id及车辆id
        $police_id=$one_case[0]['police_id'];
        $car_id=$one_case[0]['car_id'];
        //新建警员及车辆模型
        $police=M('police');
        $car=M('car');
        $one_police=$police->where("id={$police_id}")->select();
        $one_car=$car->where("id='{$car_id}'")->select();
        //新建证据模型
        $evidence=M("evidence");
        $pictur=$evidence->where("case_id=$case_id")->select();
        //数据传入
        $this->assign("evidence",$pictur);
        $this->assign('detail',$one_case[0]);
        $this->assign('police',$one_police[0]);
        $this->assign('car',$one_car[0]);

        session("evidence",$pictur);
        session("case_detail",$one_case[0]);
        $this->display();
    }
    //案件处理
    public function case_appeal(){
        //通过session得到案件数据
        $case_detail=session("case_detail");
        session("case_detail",'');//session清空
        $id=$case_detail['id'];
        $evidence=session("evidence");
        //得到案件副表
        $casehandle=M('casehandle');
        $res=$casehandle->where("case_id=$id and state2='未处理'")->select();
        //传入数据
        $this->assign("evidence",$evidence);
        $this->assign("case_detail",$case_detail);
        $this->assign("content",$res);
        $this->display('case_appeal');
    }
    //案件写入
    public function case_deal($id,$content,$punishment,$cost,$appeal,$detail_id,$change=null,$new=null){
        $case = M("case");
        $handle=M("casehandle");
        $evidence=M("evidence");
        $data['state']='normal';
        $case->startTrans();
        if($appeal=='change') {
            $case->content = $content;
            $case->punishment = $punishment;
            $case->cost = $cost;
            $case->state='未处理';
            for($i=0;$i<count($new);$i++)
            {
                $evidence->where("id=$new[$i]")->save($data);
            }
            for($j=0;$j<count($change);$j++)
            {
                $evidence->where("id=$change[$j]")->delete();
            }

        }
        else if($appeal=='no'){
            $case->state='未处理';
            for($i=0;$i<count($new);$i++)
            {
                $evidence->where("id=$new[$i]")->delete();
            }
            for($j=0;$j<count($change);$j++)
            {
                $evidence->where("id=$change[$j]")->save($data);
            }
        }
        else if($appeal=='ok'){
            $case->state='销毁';
            for($i=0;$i<count($new);$i++)
            {
                $evidence->where("id=$new[$i]")->save($data);
            }
            for($j=0;$j<count($change);$j++)
            {
                $evidence->where("id=$change[$j]")->delete();
            }
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
            $this->success('处理失败,数据异常','police_case',3);
        }
    }
    //案件审核
    public function case_pass(){
        $case_id=I('get.id');//获得案件id
        $state=I('get.state');
        $detail=M('case');
        if($state=='pass')
        {
            $detail->state='未处理';
        }else{
            $detail->state='销毁';
        }
        $one_case=$detail->where("id='{$case_id}'")->save();//新建案件模型
        $this->search("case");
    }
}

//搜索函数构造索引数组
function search_where($sheel,$search){
    if($sheel=='police') {
        $where['id'] = array('like', '%' . $search . '%');
        $where['sex'] = array('like', '%' . $search . '%');
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