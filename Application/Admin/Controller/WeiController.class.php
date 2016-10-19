<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;

use Think\Controller;
//define your token
define("TOKEN", "weixintest");
$wechatObj = new WeiController();

class WeiController extends Controller{
    public function index() {
        //获得参数 signature nonce token timestamp echostr
        $nonce     = $_GET['nonce'];
        $token     = 'weixintest';
        $timestamp = $_GET['timestamp'];
        $echostr   = $_GET['echostr'];
        $signature = $_GET['signature'];
        //形成数组，然后按字典序排序
        $array = array();
        $array = array($nonce, $timestamp, $token);
        sort($array);
        //拼接成字符串,sha1加密 ，然后与signature进行校验
        $str = sha1( implode( $array ) );
        if( $str  == $signature && $echostr ){
            //第一次接入weixin api接口的时候
            echo  $echostr;
            file_put_contents('log.txt','true:',FILE_APPEND);
            exit;
        }else{
            $this->reponseMsg();
            file_put_contents('log.txt','false:',FILE_APPEND);
        }
    }//API接口END
	
	// 接收事件推送并回复start
    public function reponseMsg() {
        //1.获取到微信推送过来post数据（xml格式）
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        //2.处理消息类型，并设置回复类型和内容
        $postObj = simplexml_load_string( $postArr );
        //判断该数据包是否是订阅的事件推送，字符串转成小写
        if( strtolower( $postObj->MsgType) == 'event'){
            //如果是关注 subscribe 事件
            
            if( strtolower($postObj->Event == 'subscribe') ){
                //图文消息个数，只能10个以内
                //回复函数  	
                $this->testsend($postObj);
            }
        }//订阅回复end
        //发送‘交警’获取交警的一些信息
        if( strtolower($postObj->MsgType == 'text'&& trim($postObj->Content)=='交警')){
            //图文消息个数，只能10个以内
        
            $this->testsend($postObj);
            //回复函数
        }
        
        //自定义菜单推送事件
        if( strtolower($postObj -> Event) == 'click'){
            $time=date('Y-m-d H:i:s',time());
            file_put_contents('log.txt','news_click:'.$time.PHP_EOL,FILE_APPEND);
            if( strtolower($postObj -> EventKey) == 'traffic_news'){
//                 $content = "无服务";
                $time=date('Y-m-d H:i:s',time());
                file_put_contents('log.txt','news1_click:'.$time.PHP_EOL,FILE_APPEND);
                $this->one_news($postObj);
            }
            if( strtolower($postObj -> EventKey) == 'V1001_GOOD'){
                $this->transmitNews($postObj);
            }
            $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
            $fromUser = $postObj->ToUserName;
            $toUser   = $postObj->FromUserName;
            $time     = time();
            $msgType  = 'text';
            echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
        }//自定义菜单  click 推送结束
    }

    //多图文消息发送  输入“交警”的时候
    public function testsend($postObj) {
        $toUser = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;
        // 图文消息个数，只能10个以内
        $arr = array(
            array(
                'title' => '上海一路口成长途汽车站点 “黄牛”在路边拉客',
                'description' => '新闻详情',
                'picUrl' => 'http://pic.qiantucdn.com/58pic/16/60/80/58b58PICTEi_1024.jpg',
                'url' => 'http://www.minqg.cc/project_4/html/newshtml/news_conternt.html'
            ),
            array(
                'title' => '交警',
                'description' => '新闻详情',
                'picUrl' => 'http://pic.qiantucdn.com/58pic/16/60/80/58b58PICTEi_1024.jpg',
                'url' => 'http://www.minqg.cc/one/index.html'
            ),
            array(
                'title' => '交警',
                'description' => '交警详情',
                'picUrl' => 'http://pic.qiantucdn.com/58pic/16/60/80/58b58PICTEi_1024.jpg',
                'url' => 'http://www.baidu.com'
            )
        );
        $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <ArticleCount>" . count($arr) . "</ArticleCount>
                        <Articles>";
        foreach ($arr as $k => $v) {
            $template .= "<item>
                        <Title><![CDATA[" . $v['title'] . "]]></Title>
                        <Description><![CDATA[" . $v['description'] . "]]></Description>
                        <PicUrl><![CDATA[" . $v['picUrl'] . "]]></PicUrl>
                        <Url><![CDATA[" . $v['url'] . "]]></Url>
                        </item>";
        }
        $template .= "</Articles>
                        </xml>";
        $result= sprintf($template, $toUser, $fromUser, time(), 'news');
        $time=date('Y-m-d H:i:s',time());
        $type=$postObj->MsgType;
        file_put_contents('log.txt','fromUsername:'.$time.$toUser.PHP_EOL,FILE_APPEND);
        file_put_contents('log.txt','toUserName:'.$time.$fromUser.PHP_EOL,FILE_APPEND);
        file_put_contents('log.txt','result:'.$time.$result.PHP_EOL,FILE_APPEND);
        file_put_contents('log.txt','postObj:'.$time.$type.PHP_EOL,FILE_APPEND);
        echo $result;
    }
    
    //单挑新闻内容
    public function one_news($postObj){
        $time=date('Y-m-d H:i:s',time());
        $news=M('news');
        $count=M('news')->count();
        $num=$count-4;
        file_put_contents('log.txt','count:'.$time.$count.PHP_EOL,FILE_APPEND);
        file_put_contents('log.txt','num:'.$time.$num.PHP_EOL,FILE_APPEND);
        $news=$news->order('id DESC')->limit(0,1)->select();
//         $news=$news->where('id=18')->select();
        file_put_contents('log.txt','news:'.$time.$news[0].PHP_EOL,FILE_APPEND);
        
        $toUser = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;
        // 图文消息个数，只能10个以内 
                foreach ($news as $key=>$val){
//                     var_dump($news)
                    $arr[]= array(
                         
                        'title' => $val['title'],
                        'description' => $val['content'],
                        'picUrl' => 'http://pic.qiantucdn.com/58pic/16/60/80/58b58PICTEi_1024.jpg',
                        'url' => 'http://www.minqg.cc/project_4/html/newshtml/news_conternt.html'
                
                    );
//                     file_put_contents('log.txt','arr[]:'.$time.$arr.PHP_EOL,FILE_APPEND);
                }
                $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <ArticleCount>" . count($arr) . "</ArticleCount>
                        <Articles>";
                foreach ($arr as $k => $v) {
                    $template .= "<item>
                        <Title><![CDATA[" . $v['title'] . "]]></Title>
                        <Description><![CDATA[" . $v['description'] . "]]></Description>
                        <PicUrl><![CDATA[" . $v['picUrl'] . "]]></PicUrl>
                        <Url><![CDATA[" . $v['url'] . "]]></Url>
                        </item>";
                }
                $template .= "</Articles>
                        </xml>";
                $result= sprintf($template, $toUser, $fromUser, time(), 'news');
                $time=date('Y-m-d H:i:s',time());
                $type=$postObj->MsgType;
                file_put_contents('log.txt','fromUsername:'.$time.$toUser.PHP_EOL,FILE_APPEND);
                file_put_contents('log.txt','toUserName:'.$time.$fromUser.PHP_EOL,FILE_APPEND);
                file_put_contents('log.txt','result:'.$time.$result.PHP_EOL,FILE_APPEND);
                file_put_contents('log.txt','postObj:'.$time.$type.PHP_EOL,FILE_APPEND);
                echo $result;
            }
    
    //纯文本消息
    public function text_send(){
        
    }
    //测试用的
    public function testclick(){
        $time=date('Y-m-d H:i:s',time());
        $news=M('news');
        $count=M('news')->count();
        $num=$count-4;
        file_put_contents('log.txt','count:'.$time.$count.PHP_EOL,FILE_APPEND);
        file_put_contents('log.txt','num:'.$time.$num.PHP_EOL,FILE_APPEND);
        $news=$news->limit(0,5)->order('id DESC')->select();
        echo $count;
        echo $num;
        var_dump($news);
    }
}