<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title> @hasSection('site.title')
                @yield('site.title')
            @else
 				意空间室内软装设计美学坊
            @endif
</title>
    
    <link rel="stylesheet" href="{{asset('/m/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('/m/css/vendor.css')}}">
    <link rel="stylesheet" href="{{asset('/m/css/style2.css')}}">
    <link rel="stylesheet" href="{{asset('/m/css/style1.css')}}">
    
    <script src="//t.dyrs.cc/static/m/scripts/init.js?20181030"></script>
    <script src="/plugin/js/vendor.js"></script>
    <script src="/plugin/js/main.js"></script>
    <script src="/plugin/js/source.js"></script>
    
<!--     <script type="text/javascript" src="{{asset('/plugin/jquery.min.js')}}"></script>  -->
    <script type="text/javascript" src="{{asset('/plugin/jquery.form.js')}}"></script> 
    
    <script type="text/javascript" src="{{asset('/plugin/swiper/4.5/js/swiper.min.js')}}"></script> 
    <script type="text/javascript" src="{{asset('/plugin/common.js')}}"></script>

	@yield('mate.js')
</head>
<body>
	
<div class="index-page" id="wrapper">
    
    @include('mobile.header')	
	
	@yield('content')
	
	@include('mobile.footer')	
</div>
	
	
</body>
</html>