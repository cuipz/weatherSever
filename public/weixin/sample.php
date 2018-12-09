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
  <div id = "l_map"></div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="http://api.map.baidu.com/api?v=2.0&ak=Na8utunCdvGrGeeArElMpjQhrIAtkk7Q"></script>
<script type="text/javascript">
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
    	'getLocation',
    	'openLocation',
      	'scanQRCode',
    ]
  });
  
  var latitude = 0.0;
  var longitude = 0.0;
    wx.ready(function () {
    wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
                //alert("latitude:" + latitude + "longitude:" + longitude);
             	var map = new BMap.Map("l_map");      
                  map.centerAndZoom(new BMap.Point(longitude, latitude), 11);          
                  var myGeo = new BMap.Geocoder();        
                  myGeo.getLocation(new BMap.Point(longitude, latitude), function(result){      
                  if (result){      
                  	alert(result.addressComponents.district);
                    var city = result.addressComponents.district.slice(0,-1);
                    alert(city);
                    city = encodeURIComponent(city);
                    window.location.href="154.8.223.24/weather?name="+city;
                    //windows.location.href = "https://www.baidu.com";
                  }
   				});
            }
        });
  });
  
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
    }
</script>
</html>