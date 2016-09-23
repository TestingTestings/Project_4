﻿

# 以下内容很重要


## 开始项目前先把填好身份好 方便后期分锅
	* 右键 turtoiseGit->设置在 Git 选项下填好自己的名称和email 
	* 不需要注册 只做识别用

## 只推送自己负责模块下的文件
	* 自己模块外的文件如果要修改一定要先在小组内讨论通过后再改

## 所有配置应在自己模块下的 conf 下修改 
	* 例如 app 模块的配置文件：Project_4\Application\App\Conf\config.php
	* （不要修改公共模块 Common 和 thinkphp 目录下的配置以及入口文件）

## 推送时的信息要完整包括以下内容 不同内容之间用“ | ”隔开：
	* 你所改动的代码的功能（必须）
	* 你修改或增加的函数的函数名与所属类的类名（必须）
	* 你负责的模块（可选）
	* 你修改的文件的文件名（可选）
	* 其他备注（可选）
	* 例： 用户登陆 | IndexController->login() | Weixin | IndexController.class.php | 缺少验证码校验


PS: 如果不小心把别人的文件覆盖了 或者 发现自己的代码被别人覆盖了 一定要第一时间提出来