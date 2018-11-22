<?php

namespace app\index\controller;

use think\Controller;

class Sign extends Controller

{
  public function index()

    {

    	return $this->fetch();

    } 
  
  public function doSign()
    
  {
   
        $param = input('post.');

    	if(empty($param['user_name'])){


    		$this->error('用户名不能为空');

    	}

    	if(empty($param['user_pwd'])){

    		$this->error('密码不能为空');

    	}

    	//$name = sha256($param['user_name']);
    
    	//$password = sha256($param['user_pwd']);
    
   		$has = db('user')->where('name', $param['user_name'])->find();

    	if(empty($has)){

          	$data = ['name' => $param['user_name'], 'password' => md5($param['user_pwd'])];
    
    		db('user')->insert($data);

    		$this->redirect(url('index.php/index/Login/index'));

    	} else {
              
          	$this->redirect(url('index.php/index/Login/index'));
                    
        }
    
  }
  
}