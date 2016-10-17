<?php
namespace Weixin\Common;


Class Captcha {
	private $width;
	private $height;
	private $code;
	private $count;
	private $img;
	private $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";


	function __construct($width=80, $height=25, $count=4){
		$this -> width = $width;
		$this -> height = $height;
		$this -> count = $count;
	}


	function create(){
		
		header("content-type:image/png");

		$this -> img = imagecreate($this -> width, $this -> height);
		$bgcolor = imagecolorallocate(
			$this -> img,  
			mt_rand(255,255),  
			mt_rand(255, 255),  
			mt_rand(255, 255)
		);

		for($i=0;$i<$this->count;$i++){

			$textcolor = imagecolorallocate(
				$this -> img,  
				mt_rand(50, 100),  
				mt_rand(50, 100),  
				mt_rand(50, 100)
			);

			$ch = $this -> charset[mt_rand(0, strlen($this -> charset)-1)];
			$this -> code .= strtoupper($ch); // 大小写宽容
			// imagettftext($this -> img, 20, mt_rand(-50,50),  5+20*$i, 20, $textcolor, './SIMLI.TTF', $ch);

			imagestring($this -> img, 5 , mt_rand(0,$this -> width), mt_rand(0,$this -> height), '/', $textcolor);
			imagestring($this -> img, 5 , mt_rand(0,$this -> width), mt_rand(0,$this -> height), '.', $textcolor);
			imagestring($this -> img, 5 , mt_rand(0,$this -> width), mt_rand(0,$this -> height), '\\', $textcolor);
			imagestring($this -> img, 20 , 5+20*$i, ($this -> height/2)-10, $ch, $textcolor);

		}
		// var_dump($this -> code);
		imagepng($this -> img);
	}


	function __destruct(){
		// imagedestroy($this -> img);
	}


	function __tostring(){
		// header("content-type:text");
		return $this -> code;
	}


	function __get($item){
		return $this -> $item;
	}


}


?>