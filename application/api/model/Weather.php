<?php

namespace app\api\model;
  
use think\Model;

use think\Db;

class Weather extends Model{
  
  public function getCityCode($cityName){
    $res = db('ins_county') -> where('county_name',$cityName) -> find();
    return $res['weather_code'];
  }
}