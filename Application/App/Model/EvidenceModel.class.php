<?php
namespace App\Model;

use Think\Model;

class EvidenceModel extends Model
{
    protected $patchValidate = true;
    public function checkdate($value){
        $valuetime=strtotime($value);
        return  NOW_TIME>=$valuetime;
    }
    //自动验证
    protected $_validate = array(  
        array('case_id','require','案件编号需填写'), 
        array('url','require','证据路径需填写！'),
        array('type','require','证据类型需填写')
       
   
       // array('law_id','require','密码必须！'),        

    );
    //自动完成
     protected $_auto=array(
       
        
        
        
        array('time',"date",3,'function')
  
    );
    

}

?>