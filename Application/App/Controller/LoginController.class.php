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
    //获得法律法规等消息
    public function lawinfo(){
        $law=D('law');
        $result=$law->query('select * from t_law limit 6 offset 146 ');
        echo json_encode($result);
        //echo $result;
        
    }
    //获得罪犯信息
    public function criminal(){
        $criminal=D('criminal');
        if(I('carid')){
            $data1['car_id']=I('carid');
            $res=$criminal->where($data1)->select();          
            echo json_encode($res);           
        }
        if(I('drivercard')){
            $data2['drive_card']=I('drivercard');
            $res2=$criminal->where($data2)->select();
            echo json_encode($res2);
        }
    }
    
    //获得所有的车牌号
    public function car(){
        $car=D('car');
        if(I('carid')){
            $data1['id']=I('carid');
            $res=$car->where($data1)->select();
            echo json_encode($res);
        }
   
    }  
    //新增事件
    public function caseup(){
        //var_dump(I('post.'));
      // $model = new \Think\Model();
       // $model->startTrans();
         $case=D('case');
  
             if(I('post.')){           
                 if($case->create()){
                $case->handletime=date("Y-m-d H:i:s" ,time());
                if($case->add()){ 
                    $caseid = $case->getLastInsID();                    
                    session('caseid',$caseid);
                    $jsonres=['state'=>'success','caseid'=>$caseid];
                    echo json_encode($jsonres);
                }
            }else{
          
          
                $errarr= $case->getError();
               // var_dump( $errarr);
                $jsonres=['state'=>'addfail','caseid'=>'$errarr'];
                echo json_encode($jsonres);
                return false;

            }
        }else{
            $jsonres=['state'=>'fail','caseid'=>'表单失败'];
            echo json_encode($jsonres);
          
        }
    
        
  if($_FILES){
            //var_dump($_FILES);
            //echo  $_FILES['file']['name'];
            //file_put_contents('log.txt',print_r($_FILES,1));
            $target_path  = "./Public/App/";//接收文件目录          
            $target_path = $target_path . basename( $_FILES['file']['name']);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                echo "The file ".  basename( $_FILES['file']['name']). " has been uploaded";
                $type=pathinfo($_FILES['file']['name'])[extension];
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
            if(I('get.caseaction')==0){
                $data2['state']  = array('in',array('未处理','修正','申诉','审核'));
            }else if(I('get.caseaction')==1){
                $data2['state']  = '审核';
            }
           
            $result=$casequery->where($data2)->select();
            //$result7=$casequery->where($data2)->select(false);
            //echo $result7;
            $result=json_encode($result);
            echo $result;
            return false;
        }else{
            if(I('get.caseaction')==0){
                $data['state']  = array('in',array('未处理','修正','申诉','审核'));
            }else if(I('get.caseaction')==1){
                $data['state']  = '审核';
            }             
           
            $result=$casequery->where($data)->order('id desc')->select();
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
    
    //删除案件
    public function delcase(){
        $percase=D("case");
        $casehandle=D("casehandle");

        $percase->startTrans();
        $result1=false;
        $result2=false;
        if(I('post.caseid')){
            //对case表格进行修改
            $data['state'] = '修正';
            $result1=$percase->where('id=%d',I('post.caseid'))->save($data);             
            //var_dump($result);
            //对evidence              
        }else{
            return false;
        }
        if(I('post.content')){
            $data2['state'] = '修正';
            $data2['state2'] = '未处理';
            $data2['content'] =I('post.content');
            $data2['case_id'] =I('post.caseid');
            $data2['happentime'] =date("Y-m-d h:i:s",time());
            $result2=$casehandle->add($data2);
            if($result2&&$result1){
                $percase->commit();
                echo "success";
            }else{
                $percase->rollback();
                echo "fail";
            }
        }else{
            return false;
        }
        

    }
    //修改案件
    public function modifycase(){
        //案件备用表        
        $casehandle=D("casehandle");
        $evidence=D("evidence");
        $case=D('case');
        if(I('post.')){
            $data5['state']='修正';
            $case->where('id=%d',I('post.caseid'))->save($data5);
            $data1['state'] = '修正';
            $data1['state2'] = '未处理';
            $data1['content'] =I('post.modifycontent');
            $data1['case_id'] =I('post.caseid');
            $data1['happentime'] =date("Y-m-d h:i:s",time());
            if($casehandle->add($data1)){                
               //case表格案件修改状态成功
            }else{
                
                return false;
            }
           
        }else{
            
        }
        
        if($_FILES){
            $target_path  = "./Public/App/";//接收文件目录
            $target_path = $target_path . basename( $_FILES['file']['name']);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
                echo "The file ".  basename( $_FILES['file']['name']). " has been uploaded";
                $type=pathinfo($_FILES['file']['name'])['extension'];
                //判断文件的格式，如果是视频/音频，要将以前的视音频改为change的状态
               
                if($type=='mp3'||$type=='mp4'){
                    $data2['state'] = 'change';
                    if($type=='mp3'){
                        $data4['type'] = 'mp3';
                     }else if($type=='mp4'){
                         $data4['type'] = 'mp4';
                     }
                     $data4['case_id']=I('get.caseid');
                    $result1=$evidence->where($data4)->save($data2);
                }
                $data['url'] =  $target_path;
                $data['type'] = $type;
                $data['case_id'] =I('get.caseid');
                 $data['time'] = date("Y-m-d h:i:s",time());
                $data['state']='new';
                //$data['handletime']='0000-00-00 00:00:00';
                if( $evidence->create($data)){
                    if($evidence->add()){
                        echo "fileadd";
                    }else{
                        $flag=false;
                        echo "fileaddfail";
                    }
                     
                }else{
                    $err= $evidence->getError();
                    var_dump($err);
                    echo I('get.caseid');
                    echo "create fail";
                    return false;
                }
        
            }  else{
                echo "There was an error uploading the file, please try again!" . $_FILES['file']['error'];
                return false;
            }
        }
    }
    public function modifyproof(){
        var_dump(I('post.'));
        //echo I('post.caseid');
        $case=D("case");
        $casehandle=D("casehandle");
        $evidence=D("evidence");
        if(I('post.caseid')){
            $data['state']='修正';
            $res=$case->where('id=%d',I('post.caseid'))->save($data);
            $data1['state'] = '修正';
            $data1['state2'] = '未处理';
            $data1['content'] =I('post.content');
            $data1['case_id'] =I('post.caseid');
            $data1['happentime'] =date("Y-m-d h:i:s",time());
            $res=$casehandle->add($data1);
            $data2=explode(",",I('post.delimgarr'));
            var_dump($data2);
            for($i=0;$i<count($data2);$i++){
                $data3['case_id']=I('post.caseid');
                $data3['id']=$data2[$i];
                
               // echo  $data3['id'];
                $data4['state']='change';
                $res=$evidence->where($data3)->save($data4);
            }
            if($res){
                echo "success";                
            }else{
                echo "fail";
            }
        }
    }

    
}

?>