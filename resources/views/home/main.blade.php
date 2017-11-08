<?php
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>{{$_sysConfig->title}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<script src="{{asset('/plugin/web/js/jquery.min.js')}}"></script>
	
	
	<link href="{{asset('/css/white_lobby_menu.css')}}" rel="stylesheet">
    <link href="{{asset('/css/standard.css')}}" rel="stylesheet">
    <link href="{{asset('/css/balls.css')}}" rel="stylesheet">
    <link href="{{asset('/css/game_main.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bet.css')}}" rel="stylesheet">
    <link href="{{asset('/css/g_HK6.css')}}" rel="stylesheet">
    
    
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    
</head>
<body>
	<div style="position: relative;height: auto; min-height: 100%;">
		<div >
				@include('home.top') 
				<div style="clear:both;"></div>
		</div>
		<div>
     			@include('home.notes') 
     			<div style="clear:both;"></div>
     	</div>		
     	<div style=" padding-bottom: 82px;">		
     			@yield('content')
     			<div style="clear:both;"></div>
		</div>				
		<div style="position: absolute; bottom: 0; height: 80px;text-align: center;width: 100%;">
    			@include('home.footer')	
    	</div>			
    </div>
				
</body>
</html>	
	
	
	
	
	
	
	
	