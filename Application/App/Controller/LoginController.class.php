<?php
namespace App\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function login(){
       
       
        //后台再次防止输入为空的进来
       if(I('post.tpname')!==""&&I('post.tppwd')!==""){
        //var_dump(I('post.tppwd'));
            $police = M("police"); // 实例化User对象
            $condition['name'] = I('post.tpname');
            $condition['password'] = md5(I('post.tppwd'));
            $condition['state'] ='normal';
           
            //var_dump($condition);
            //$condition['imei']=I('post.imei');
             // 把查询条件传入查询方法
            $result=$police->where($condition)->select();          
            if(count($result)!=0){
               // echo "success";//账号或密码正确
                if($result[0]['imei']==I('post.imei')){
                    $result=['result'=>'ok','state'=>$result[0]['id']];
                    echo json_encode($result);
                }else{
                    $result=['result'=>'err','state'=>"需要在本机上登陆"];
                    echo json_encode($result);
                }
            }else{
               $result=['result'=>'err','state'=>"账号或密码错误"];
               echo json_encode($result);
            }
        }else{
            $result=['result'=>'err','state'=>"不能为空哦"];
            echo json_encode($result); 
        }   
    }
    
    //新增事件
    public function caseup(){
        //var_dump(I('post.'));
      // $model = new \Think\Model();
       // $model->startTrans();
   
        $case=D("case");
        $flag=true;
       
        if(I('post.')){           
            if($case->create()){
                $case->handletime=date("Y-m-d H:i:s" ,time());
                if($case->add()){ 
                    $caseid = $case->getLastInsID();                  
                    session('caseid',$caseid);
                    echo "success";
                }
            }else{
                $flag=false;
                echo "添加失败，请重试";
                $errarr= $case->getError();
                return false;
            /*     for(var $key in $value){
                    
                } */             
               
            }
        }else{
            $flag=false;
            echo "没有表单提交";
        }
        
  
        if($_FILES){
            //var_dump($_FILES);
            //echo  $_FILES['file']['name'];
            //file_put_contents('log.txt',print_r($_FILES,1));
            $target_path  = "./Public/App/";//接收文件目录          
            $target_path = $target_path . basename( $_FILES['file']['name']);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                echo "The file ".  basename( $_FILES['file']['name']). " has been uploaded";
                $type=$_FILES['file'][type];
                $evidence=D("evidence");
                $data['url'] =  $target_path;
                $data['type'] = $type;
                $data['case_id'] = session('caseid');
                $data['time'] = date("Y-m-d h:i:s",time());
                
                if( $evidence->create($data)){
                    if($evidence->add()){
                     
                       echo "fileadd";  
                    }else{
                        $flag=false;
                        echo "fileaddfail";
                    }
                   
                }else{
                    $err= $case->getError();
                    var_dump($err);
                    $flag=false;
                    echo "create fail";
                    return false;
                }
                
            }  else{
                echo "There was an error uploading the file, please try again!" . $_FILES['file']['error'];
                return false;
            } 
  
            
        }
     
    }
    

    //案件查询
    public function query(){
        $casequery=D("case");
        //如果搜索，只显示搜索的内容
        if(I('post.sou')){
            //echo I('post.sou');
            $sou=I('post.sou');
            $a=preg_match('/['.chr(0xa1).'-'.chr(0xff).']/', $sou);
            if($a){
                
            }else{
                $data['happentime'] = array('like',$sou.'%');
            }
            $data['place'] = array('like','%'.$sou.'%');
       
           
      
            $data['content'] = array('like','%'.$sou.'%');
         
            $data['car_id'] = array('like','%'.$sou.'%');
            $data['_logic'] = 'or';
            $data2['_complex']=$data;
            $result=$casequery->where($data2)->select();
            $result=json_encode($result);
            echo $result;
            return false;
        }else{
    
            $result=$casequery->order('id desc')->select();
            // echo gettype($result);
            $result=json_encode($result);
            // var_dump($result);
            echo $result;
        }
    }
    
    
    
    //各个案件查询
    public function caseinfo(){
       $percase=D("case");
       $evidence=D("evidence");
        if(I('post.caseid')){
            //echo I('post.caseid');
            $result1=$percase->where('id=%s',I('post.caseid'))->select();
            $result2=$evidence->where('case_id=%s',I('post.caseid'))->select();
            $result=['evidence'=>$result2,'case'=>$result1];
            $result=json_encode($result);
            //var_dump($result);
            echo $result;
        }   
    }
}

?>