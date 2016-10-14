<?php
namespace App\Model;

use Think\Model;

class CaseModel extends Model
{
    protected $patchValidate = true;
    public function checkdate($value){
        $valuetime=strtotime($value);
        return  NOW_TIME>=$valuetime;
    }
    //自动验证
    protected $_validate = array(
   
        //array('place','require','案件地名需填写'),
        array('drive_card','require','驾驶证号码需填写'),
        array('log','require','经度需填写！'),
        array('lat','require','纬度需填写'),
        array('police_id','require','交警id需填写'),
        array('car_id','require','车牌号需填写'),
        array('happentime','require','发生时间需填写！'),
        array('content','require','案件原因需填写！'),
        array('cost','require','罚单需填写！'),
        array('punishment','require','惩罚方式需填写！'),
        array('infoway','require','信息来源需填写！') ,     
        array('score','require','需要写入分！')
       // array('law_id','require','密码必须！'),        

    );
    //自动完成
    
    protected $_auto=array(
      //  array('handletime',"date",3,'function'),
        array('law_id',"1"),
         array('state','审核')
    );
    

}

?>