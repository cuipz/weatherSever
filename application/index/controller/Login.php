<?php

namespace app\index\controller;

 

use think\Controller;

 

class Login extends Controller

{

    public function index()

    {

    	return $this->fetch();

    }   
  
  // 处理登录逻
  
    public function dologin()

    {

    	$param = input('post.');

    	if(empty($param['user_name'])){

    		$this->error('用户名不能为空');

    	}

    	if(empty($param['user_pwd'])){

    		$this->error('密码不能为空');

    	}

     // 	$name = sha256($param['user_name']);
      
     // 	$password = sha256($param['user_pwd']);
      
    	// 验证用户名

    	$has = db('user')->where('name', $param['user_name'])->find();

    	if(empty($has)){

    		$this->error('用户名密码错误');

    	}

    	// 验证密码

    	if($has['password'] != md5($param['user_pwd'])){

    		$this->error('用户名密码错误');

    	}

    	// 记录用户登录信息

    	cookie('user_id', $has['id'], 3600);  // 一个小时有效期

    	cookie('user_name', $has['name'], 3600);

    	$this->redirect(url('index.php/index/Index/index'));

    }
  
  public function loginOut()

    {

    	cookie('user_id', null);

    	cookie('user_name', null);

    	

    	$this->redirect(url('index.php/index/Login/index'));

    }

}