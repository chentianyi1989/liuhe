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
    
	<script type="text/javascript">

		var sheng_xiao = ["羊","猴","鸡","狗","猪","鼠","牛","虎","兔","龙","蛇","马"];
    	$(function () {

    		createPingMa ();
    		createTeMa ();
    		
    	});

    	function createPingMa () {
    		var trs = []
    		for(var i =0;i<10;i++){
    			trs[i] = $("<tr>")
    		}

    		for (var i=1;i<=49;i++) {
    			
    			trs[i%10].append(createItem(i,"pingma"));
    		}

    		for (var i=1;i<10;i++) {
    			$("#pingma_table").append(trs[i]);
    		}
    		$("#pingma_table").append(trs[0]);
    	}
    	
    	function createItem (index,type) {

    		var rs = ['<td class="GTM GTM0 name" name="'+type+'_label_td'+index+'">'];
    		if (index>=10) {
    			rs.push('<span class="b'+index+'"></span></td>');
    		}else {
    			rs.push('<span class="b0'+index+'"></span></td>');
    		}
    		var sx = sheng_xiao[index%12];
    		rs.push('<td name="'+type+'_label_td'+index+'">'+sx+'</td>');
    		rs.push('<td class="GTM GTM0 amount ha" name="'+type+'_val_td'+index+'">');
    		rs.push(createMontyInput(index,sx,type));
    		rs.push('</td>');

    		return rs.join("");
    	}

    	function createMontyInput (code,sx,type) {

    		return [
    			"<input onfocusout=\"this.value=this.value.replace(/\D/g,'')&amp;&amp;this.value^0|[1-9][0-9]*$\"",
    	    	"onmouseout=\"this.value=this.value.replace(/\D/g,'')&amp;&amp;this.value^0|[1-9][0-9]*$\"",
    	    	"onkeyup=\"this.value=this.value.replace(/\D/g,'')&amp;&amp;this.value^0|[1-9][0-9]*$\"",
    	    	"onkeydown=\"this.value=this.value.replace(/\D/g,'')&amp;&amp;this.value^0|[1-9][0-9]*$\"",
    	    	"onkeypress=\"if ((event.keyCode<48 || event.keyCode>57)) event.returnValue=false\"",
    	    	"onafterpaste=\"this.value=this.value.replace(/\D/g,'').replace(/^0+/g,'')\"",
    	    	'class="tmthis ba" maxlength="6" code="'+code+'" name="'+type+'_money[]"',
    	    	'sx="'+sx+'"',
    	    	'type="'+type+'">'
    		].join("");
    	}

    	function createTeMa () {
    		var trs = []
    		for(var i =0;i<10;i++){
    			trs[i] = $("<tr>")
    		}

    		for (var i=1;i<=49;i++) {
    			
    			trs[i%10].append(createItem(i,"tema"));
    		}

    		for (var i=1;i<10;i++) {
    			$("#tema_table").append(trs[i]);
    		}
    		$("#tema_table").append(trs[0]);
    	}

    	
	</script>
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
	
	
	
	
	
	
	
	