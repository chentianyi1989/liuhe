<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ycTgY5YTSnk5PsqumqZboxtXaKU6Io6K"></script>
	<title>根据城市名设置地图中心点</title>
</head>
<body>
	<div id="allmap"></div>
	<div id="r-result"></div>
</body>
</html>
<script type="text/javascript">

	
	// 百度地图API功能
	var map = new BMap.Map("allmap");  // 创建Map实例
	map.centerAndZoom("湘阴县意空间室内软装设计美学坊",18);      // 初始化地图,用城市名设置地图中心点
	setTimeout(function(){
		map.setZoom(18);   
	}, 2000);  //2秒后放大到14级
	map.enableScrollWheelZoom(true);
	
	var point = new BMap.Point(112.910129,28.681715);
	var sContent ="湘阴县意空间室内软装设计美学坊";
	var infoWindow = new BMap.InfoWindow(sContent);
	map.openInfoWindow(infoWindow,point); //开启信息窗口
	document.getElementById("r-result").innerHTML = "信息窗口的内容是：<br />" + infoWindow.getContent();
</script>