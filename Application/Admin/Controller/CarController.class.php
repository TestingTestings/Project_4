<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class CarController extends Controller {
    //车辆信息
    public function index(){
//         $id=session('user_id','hys11');
//         var_dump($expression) ;
        $car = M('car'); // 实例化User对象
        $count = $car->count();// 查询满足要求的总记录数
        //         echo $count;
        $Page = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        $Page->setConfig('header','<p style="display: inline">共<b>%TOTAL_ROW%</b>条记录&nbsp;</p>');
        
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $car->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('carlists',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('car'); // 输出模板
    }
    //车辆查询
    public function car_search(){
        $search=I('menuname');
        $select=I('select');
//         echo $select;
        $car=M('car');
        if($select=='车牌号'){
            $sea['id'] = array('like','%'.$search.'%');
        }elseif ($select=='类型'){
            $sea['type'] = array('like','%'.$search.'%');
        }elseif ($select=='识别号'){
            $sea['vin'] = array('like','%'.$search.'%');
        }elseif ($select=='地区'){
            $sea['local'] = array('like','%'.$search.'%');
        }elseif ($select=='颜色'){
            $sea['color'] = array('like','%'.$search.'%');
        }
        
        $count = $car->where($sea)->count();// 查询满足要求的总记录数
//         echo $count;
       
        $Page = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        $Page->setConfig('header','<p style="display: inline">共<b>%TOTAL_ROW%</b>条记录&nbsp;</p>');
        
//         分页跳转的时候保证查询条件
        foreach($sea as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        
        $show = $Page->show();// 分页显示输出        
//         $list=$car->where($sea)->select();
        $list = $car->limit($Page->firstRow.','.$Page->listRows)->where($sea)->select();       
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('carlists',$list);
        $this->display('car');
    }
    //新闻信息
    public function news(){
        $news = M('news'); // 实例化User对象
        $count = $news->count();// 查询满足要求的总记录数
        //         echo $count;
        $Page = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        $Page->setConfig('header','<p style="display: inline">共<b>%TOTAL_ROW%</b>条记录&nbsp;</p>');
        
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $news->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('newslists',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('news'); // 输出模板
    }
    //新闻查询
    public function news_search(){
        $search=I('search');
        $select=I('select');
        //         echo $select;
        $news=M('news');
        if($select=='标题'){
            $sea['title'] = array('like','%'.$search.'%');
        }elseif ($select=='内容'){
            $sea['content'] = array('like','%'.$search.'%');
        }elseif ($select=='日期'){
            $sea['time'] = array('like','%'.$search.'%');
        }elseif ($select=='有效期'){
            $sea['valid'] = array('like','%'.$search.'%');
        }
        
        $count = $news->where($sea)->count();// 查询满足要求的总记录数
//         echo $count;
         
        $Page = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        $Page->setConfig('header','<p style="display: inline">共<b>%TOTAL_ROW%</b>条记录&nbsp;</p>');
        
        //         分页跳转的时候保证查询条件
        foreach($sea as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        
        $show = $Page->show();// 分页显示输出
        //         $list=$car->where($sea)->select();
        $list = $news->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->where($sea)->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('newslists',$list);
        $this->display('news');
    }
    //新闻添加界面
    public function add_news(){
        $news=D('news');
        
        $this->display();
    }
    //新闻添加
    public function addAction(){
        $news=D('news');
        if(!empty($_FILES)){
            //上传单个图像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     1*1024*1024 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =      'Public/Common/news_img/'; // 设置附件上传根目录
            $upload->savePath  =      ''; // 设置附件上传（子）目录
            $upload->saveName=array('uniqid','news');//上传文件的保存规则
            $upload->autoSub  = true;//自动使用子目录保存上传文件
            $upload->subName  = array('date','Ymd');
            // 上传单个图片
            $info   =   $upload->upload();
//             var_dump($info['url']['savepath'].$info['url']['savename']);
            
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }
        }
        $rule=array(
            array('title','require','标题不能为空'),
            array('content','require','内容不能为空'),
            array('time','require','发布时间不能为空'),
            array('valid','require','有效时间不能为空'),
            array('url','require','图片不能为空')
        );
        $title=$_POST['title'];
        $content=$_POST['content'];
        $time=$_POST['time'];
        $valid=$_POST['valid'];
//         $url=$_POST['url'];
        $img_url='/Project_4/Public/Common/news_img/'.$info['url']['savepath'].$info['url']['savename'];
        $data['title']=$title;
        $data['content']=$content;
        $data['valid']=$valid;
        $data['time']=$time;
        $data['url']=$img_url;
//         var_dump($img_url);
//         die();
        if ($news->validate($rule)->create($data)){
            if ($news->add()){
                $this->success('add success','news');
//                 $this->display('news');
            }else {
                $this->error($news->getError());
            } 
        }
        else {
            $this->error($news->getError());
        }
    }
    //单条新闻显示
    public function change($id){
        $news=M('news');
        $news=$news->find($id);
//         var_dump($news);
        $this->assign('one_news',$news);
        $this->display();   
    }
    //新闻修改
    public function changeAction(){
        $id=$_GET['id'];
        $news=D('news');
        if ($news->create()){
            if ($news->where('id=%d',array($id))->save()){
                $this->success('修改成功','news');
            }else {
                $this->error($news->getError());
            }
        }
        else {
            $this->error($news->getError());
        }
           
    }
    //新闻预览
    public function news_traffic($id){
        $id=$_GET['id'];
        $news=M('news');
        $news=$news->find($id);
        $this->assign('one_news',$news);
        $this->display();
    }
    //通缉犯信息
    public function criminal(){
        $criminal=D('criminal');
//         criminallists
        $count = $criminal->count();// 查询满足要求的总记录数
        //         echo $count;
        $Page = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        $Page->setConfig('header','<p style="display: inline">共<b>%TOTAL_ROW%</b>条记录&nbsp;</p>');
        
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $criminal->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
//         var_dump($list);
        $this->assign('criminallists',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('criminal'); // 输出模板
    }
    //通缉犯查询
    public function criminal_search(){
        $search=I('search');
        $select=I('select');
        //         echo $select;
        $criminal=M('criminal');
        if($select=='姓名'){
            $sea['name'] = array('like','%'.$search.'%');
        }elseif ($select=='罪状'){
            $sea['action'] = array('like','%'.$search.'%');
        }elseif ($select=='状态'){
            $sea['state'] = array('like','%'.$search.'%');
        }
        
        $count = $criminal->where($sea)->count();// 查询满足要求的总记录数
        //         echo $count;
         
        $Page = new \Think\Page($count,7);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme','%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%');
        $Page->setConfig('header','<p style="display: inline">共<b>%TOTAL_ROW%</b>条记录&nbsp;</p>');
        
        //         分页跳转的时候保证查询条件
        foreach($sea as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        
        $show = $Page->show();// 分页显示输出
        $list = $criminal->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->where($sea)->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('criminallists',$list);
        $this->display('criminal');
    }
    //t通缉犯状态更改
    public function state_criminal($id){
        $id=$_GET['id'];
        $state=$_GET['state'];
        $criminal=D('criminal');
        if ($state=='在逃'){
            $data['state'] = '抓获';
            if ($criminal->where('id=%d',array($id))->save($data)){
                $this->success('成功缉拿','criminal'); 
            }else {  
            }
        }elseif ($state=='抓获'){
            
            $data['state'] = '在逃';
            if ($criminal->where('id=%d',array($id))->save($data)){
                $this->success('逃亡中,请派兵捉拿','criminal');
            }
        }
    }
    //通缉犯添加
    public function add_criminalAction(){
        $criminal=D('criminal');     
        if(!empty($_FILES)){
            //上传单个图像
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     1*1024*1024 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =      'Public/Common/head_img/'; // 设置附件上传根目录
            $upload->savePath  =      ''; // 设置附件上传（子）目录
            $upload->saveName=array('uniqid','head_img1');//上传文件的保存规则
            $upload->autoSub  = true;//自动使用子目录保存上传文件
            $upload->subName  = array('date','Ymd');
            // 上传单个图片
            $info   =   $upload->upload();
            
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }     
        $rule=array(
            array('name','require','名字不能为空'),
            array('action','require','罪状不能为空'),
            array('head','require','头像不能为空'),
            array('driver_id','require','驾驶证号不能为空'),
            array('car_id','require','车牌号不能为空')
        );
        $name=$_POST['name'];
        $action=$_POST['action'];
        $state=$_POST['state'];
        $driver_id=$_POST['driver_id'];
        $car_id=$_POST['car_id'];
        $img_url='/Project_4/Public/Common/head_img/'.$info['head']['savepath'].$info['head']['savename'];
        $data['head']=$img_url;
        $data['name']=$name;
        $data['action']=$action;
        $data['state']=$state;
        $data['car_id']=$car_id;
        $data['driver_car']=$driver_id;
        if ($criminal->validate($rule)->create($data)){
            if ($criminal->add()){
                $this->success('add success','criminal');
                //                 $this->display('news');
            }else {
                $this->error($criminal->getError());
            }
        }
        else {
            $this->error($criminal->getError());
        }
    }
    }
    //罪犯删除
    Public function del_criminalAction(){
        


        $id=$_GET['id'];
        $criminal=M('criminal');
        //         $student->create();
        if ($criminal->delete($id)){
            $this->success('del success','criminal');
            //                 $this->display('news');
        }else {
            $this->error($criminal->getError());
        }
//         $criminal->delete($id);
//         $this->display('criminal');
    }
    //appcan上的新闻显示
    public function appcan_news(){
        $news=M('news');
        $list = $news->order('id DESC')->select();
        echo json_encode($list);
    }

}