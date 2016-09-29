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
        $Page = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
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
        echo $count;
       
        $Page = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
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
        $Page = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $news->limit($Page->firstRow.','.$Page->listRows)->select();
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
        echo $count;
         
        $Page = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page->setConfig('header','$count 记录');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        //         分页跳转的时候保证查询条件
        foreach($sea as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        
        $show = $Page->show();// 分页显示输出
        //         $list=$car->where($sea)->select();
        $list = $news->limit($Page->firstRow.','.$Page->listRows)->where($sea)->select();
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
//         $title=$_POST['title'];
//         $content=$_POST['content'];
//         $time=$_POST['time'];
//         $valid=$_POST['valid'];
//         echo $title;
        $news=D('news');
        $rule=array(
            array('title','require','标题不能为空'),
            array('content','require','内容不能为空'),
            array('time','require','发布时间不能为空'),
            array('valid','require','有效时间不能为空')
        );
        if ($news->validate($rule)->create()){
            if ($news->add()){
                $this->success('add success');
            }else {
                $this->error($news->getError());
            } 
        }
        else {
            $this->error($news->getError());
        }
//         if($title!=''){
//             $news->create();
//             $news->add();
//             $this->display('');
//         }else {
            
//         }
        
        
    }

}