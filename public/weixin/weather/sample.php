<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx2244cb06a7ddb2d6", "0ee56be36878968fb83c389434a7cf58");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
 
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
    	'getLocation',
    	'openLocation',
      	'scanQRCode',
    ]
  });
  
  var latitude = 0.0;
  var longitude = 0.0;
  //function getLocation(){
    wx.ready(function () {
    // 在这里调用 API
    wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
                alert("latitude:" + latitude + "longitude:" + longitude);
          //      window.location.href = "http://api.map.baidu.com/geocoder/v2/?callback=renderReverse&location=" + latitude + "," + longitude + "&output=json&pois=1&ak=Na8utunCdvGrGeeArElMpjQhrIAtkk7Q";
            }
    //      window.location.href = "http://api.map.baidu.com/geocoder/v2/?callback=renderReverse&location=" + latitude + "," + longitude + "&output=json&pois=1&ak=Na8utunCdvGrGeeArElMpjQhrIAtkk7Q";
        });
       // window.location.href = "http://api.map.baidu.com/geocoder/v2/?callback=renderReverse&location=" + latitude + "," + longitude + "&output=json&pois=1&ak=Na8utunCdvGrGeeArElMpjQhrIAtkk7Q";
  });
    
  //}
    /*
    var map = new BMap.Map("l-map");      
      map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);      
      // 创建地理编码实例      
      var myGeo = new BMap.Geocoder();      
      // 根据坐标得到地址描述    
      myGeo.getLocation(new BMap.Point(116.364, 39.993), function(result){      
          if (result){      
          alert(result.address);      
          }      
   });
  
  function get(){
   		 $url_get='http://api.map.baidu.com/geocoder/v2/?callback=renderReverse&location=' + latitude + ',' + longitude + '&output=json&pois=1&ak=Na8utunCdvGrGeeArElMpjQhrIAtkk7Q';
         $user_json= $this->https_request($url_get);
         var_dump($user_json);
  }
  
  function https_request ($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $out = curl_exec($ch);
        curl_close($ch);
        return  json_decode($out,true);
    }
  
  function openLocation() {
        wx.ready(function () {
            wx.openLocation({
                latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
                longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
                name: '', // 位置名
                address: '', // 地址详情说明
                scale: 15, // 地图缩放级别,整形值,范围从1~28。默认为最大
                infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
            });
        });
    }
  /*
    function scanQRCode() {
        wx.ready(function () {
            wx.scanQRCode({
                needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                }
            });
        });
    }*/
  
  //<a href="javascript:;" onclick="getLocation()" class="weui_btn weui_btn_primary">调用地图</a>
</script>
</html>