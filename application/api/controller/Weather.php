<?php

namespace app\api\controller;

use think\Controller;

class Weather extends Controller{
  
  public function read(){
	$name = input('name');
   // $name = (isset($_GET['name']))?$_GET['name'];
    var_dump("1");
    $model = model('Weather');
    $data = $model -> getCityCode($name);
    if($data){
      $code = 200;
    } else {
      $code = 404;
    }
   // $data = ['code' => $code,'data' => $data];
    return $data;
  }
}