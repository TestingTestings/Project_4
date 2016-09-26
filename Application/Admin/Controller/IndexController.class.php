<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        $this->display('index');
    }
    public function welcome(){
        $title=M('menu');
        $menu=$title->select();
        $this->assign('menu',$menu);
        $this->display('welcome');
    }
}