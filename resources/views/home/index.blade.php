<?php 
$rs = [
    "dama"=>[],
    "xiaoma"=>[],
    "danma"=>[],
    "xiaodan"=>[],
    "dadan"=>[],
    "shuangma"=>[],
    "xiaoshuang"=>[],
    "dashuang"=>[],
    "hedan"=>[],
    "heshuang"=>[],
    "heda"=>[],
    "hexiao"=>[],
    
    "tou0"=>[],
    "tou1"=>[],
    "tou2"=>[],
    "tou3"=>[],
    "tou4"=>[],
    "wei0"=>[],
    "wei1"=>[],
    "wei2"=>[],
    "wei3"=>[],
    "wei4"=>[],
    "wei5"=>[],
    "wei6"=>[],
    "wei7"=>[],
    "wei8"=>[],
    "wei9"=>[],
    
    "shengxiao_shu"=>[],
    "shengxiao_niu"=>[],
    "shengxiao_hu"=>[],
    "shengxiao_tu"=>[],
    "shengxiao_long"=>[],
    "shengxiao_she"=>[],
    "shengxiao_ma"=>[],
    "shengxiao_yang"=>[],
    "shengxiao_hou"=>[],
    "shengxiao_ji"=>[],
    "shengxiao_gou"=>[],
    "shengxiao_zhu"=>[],
    
    "red"=>[1,2,7,8,12,13,18,19,23,24,29,30,34,35,40,45,46],
    "red_dan"=>[1,7,13,19,23,29,35,45],
    "red_shuang"=>[2,8,12,18,24,30,34,40,46],
    "red_da"=>[29,30,34,35,40,45,46],
    "red_xiao"=>[1,2,7,8,12,13,18,19,23,24],
    
    "blue"=>[3,4,9,10,14,15,20,25,26,31,36,37,41,42,47,48],
    "blue_dan"=>[3,9,15,25,31,37,41,47],
    "blue_shuang"=>[4,10,14,20,26,36,42,48],
    "blue_da"=>[25,26,31,36,37,41,42,47,48],
    "blue_xiao"=>[3,4,9,10,14,15,20],
    
    "green"=>[5,6,11,16,17,21,22,27,28,32,33,38,39,43,44,49],
    "green_dan"=>[5,11,17,21,27,33,39,43,49],
    "green_shuang"=>[6,16,22,28,32,44],
    "green_da"=>[27,28,32,33,38,39,43,44,49],
    "green_xiao"=>[5,6,11,16,17,21,22]
];


for ($i=1;$i<=49;$i++) {
    
    if($i>=25) {
        $rs["dama"][] = $i;
        if ($i%2==1) {
            $rs["dadan"][] = $i;
            $rs["danma"][] = $i;
        }else {
            $rs["dashuang"][] = $i;
            $rs["shuangma"][] = $i;
        }
    }else {
        $rs["xiaoma"][] = $i;
        if ($i%2==1) {
            $rs["xiaodan"][] = $i;
            $rs["danma"][] = $i;
        }else {
            $rs["xiaoshuang"][] = $i;
            $rs["shuangma"][] = $i;
        }
    }
    
    $gewei = $i%10;
    $shiwei = intval($i/10);
    $heshu =  $gewei + $shiwei;
    if ($heshu>=7) {
        $rs["heda"][] = $i;
    }else {
        $rs["hexiao"][] = $i;
    }
    if ($heshu%2==1) {
        $rs["hedan"][] = $i;
    }else {
        $rs["heshuang"][] = $i;
    }
    
    if($shiwei == 0) {
        $rs["tou0"][] = $i;
    }else if ($shiwei == 1) {
        $rs["tou1"][] = $i;
    }else if ($shiwei == 2) {
        $rs["tou2"][] = $i;
    }else if ($shiwei == 3) {
        $rs["tou3"][] = $i;
    }else if ($shiwei == 4) {
        $rs["tou4"][] = $i;
    }
    
    if($gewei == 0) {
        $rs["wei0"][] = $i;
    }else if($gewei == 1) {
        $rs["wei1"][] = $i;
    }else if($gewei == 2) {
        $rs["wei2"][] = $i;
    }else if($gewei == 3) {
        $rs["wei3"][] = $i;
    }else if($gewei == 4) {
        $rs["wei4"][] = $i;
    }else if($gewei == 5) {
        $rs["wei5"][] = $i;
    }else if($gewei == 6) {
        $rs["wei6"][] = $i;
    }else if($gewei == 7) {
        $rs["wei7"][] = $i;
    }else if($gewei == 8) {
        $rs["wei8"][] = $i;
    }else if($gewei == 9) {
        $rs["wei9"][] = $i;
    }
    
    $sx=$i%12;
    if($sx == 1) {
        $rs["shengxiao_hou"][] = $i;
    }else if ($sx == 2){
        $rs["shengxiao_ji"][] = $i;
    }else if ($sx == 3){
        $rs["shengxiao_gou"][] = $i;
    }else if ($sx == 4){
        $rs["shengxiao_zhu"][] = $i;
    }else if ($sx == 5){
        $rs["shengxiao_shu"][] = $i;
    }else if ($sx == 6){
        $rs["shengxiao_niu"][] = $i;
    }else if ($sx == 7){
        $rs["shengxiao_hu"][] = $i;
    }else if ($sx == 8){
        $rs["shengxiao_tu"][] = $i;
    }else if ($sx == 9){
        $rs["shengxiao_long"][] = $i;
    }else if ($sx == 10){
        $rs["shengxiao_she"][] = $i;
    }else if ($sx == 11){
        $rs["shengxiao_ma"][] = $i;
    }else if ($sx == 0){
        $rs["shengxiao_yang"][] = $i;
    }
}


for ($i=1;$i<=49;$i++) {
    
    if($i>=25) {
        $rs["dama"][] = $i;
        if ($i%2==1) {
            $rs["danma_da"][] = $i;
            $rs["danma"][] = $i;
        }else {
            $rs["shuangma_da"][] = $i;
            $rs["shuangma"][] = $i;
        }
    }else {
        $rs["xiaoma"][] = $i;
        if ($i%2==1) {
            $rs["danma_xiao"][] = $i;
            $rs["danma"][] = $i;
        }else {
            $rs["shuangma_xiao"][] = $i;
            $rs["shuangma"][] = $i;
        }
    }
    
    $gewei = $i%10;
    $shiwei = intval($i/10);
    $heshu =  $gewei + $shiwei;
    if ($heshu>=7) {
        $rs["heda"][] = $i;
    }else {
        $rs["hexiao"][] = $i;
    }
    if ($heshu%2==1) {
        $rs["hedan"][] = $i;
    }else {
        $rs["heshuang"][] = $i;
    }
    
    if($shiwei == 0) {
        $rs["tou0"][] = $i;
    }else if ($shiwei == 1) {
        $rs["tou1"][] = $i;
    }else if ($shiwei == 2) {
        $rs["tou2"][] = $i;
    }else if ($shiwei == 3) {
        $rs["tou3"][] = $i;
    }else if ($shiwei == 4) {
        $rs["tou4"][] = $i;
    }
    
    if($gewei == 0) {
        $rs["wei0"][] = $i;
    }else if($gewei == 1) {
        $rs["wei1"][] = $i;
    }else if($gewei == 2) {
        $rs["wei2"][] = $i;
    }else if($gewei == 3) {
        $rs["wei3"][] = $i;
    }else if($gewei == 4) {
        $rs["wei4"][] = $i;
    }else if($gewei == 5) {
        $rs["wei5"][] = $i;
    }else if($gewei == 6) {
        $rs["wei6"][] = $i;
    }else if($gewei == 7) {
        $rs["wei7"][] = $i;
    }else if($gewei == 8) {
        $rs["wei8"][] = $i;
    }else if($gewei == 9) {
        $rs["wei9"][] = $i;
    }
}

// print_r($rs);
// foreach ($rs as $key => $value) {
//     echo "\"$key\":[";
//     foreach ($value as $v){
//         echo $v.",";
//     }
//     echo "]\n";
// }


?>
@extends('home.main')

@section('content')

<!-- {{$currGameResult->code or '12' }} -->
<!--{{asset('/mabao/')}}/<?php echo rand(1,100);?>.jpg-->
<img style="width: 500px;height: 680px;position:absolute;" src="{{asset('/mabao/')}}/{{$currGameResult->code or '12' }}.jpg" >
<!-- style="margin-left: 600px" -->
<div class="L_HK6 P_tm skin_red lhc_center" style="margin-left: 600px">
    <div id="main">
        <div id="bet_panel" class="bet_panel input_panel bet_closed">
             @include('home.pingma')
        </div>
    </div>
    @include('home.kuaijie_pingma')
    <div style="clear:both;"></div>
</div>
		
	
<div class="L_HK6 P_tm skin_red lhc_center" style="margin-left: 600px">
	<div id="main">
		<div id="bet_panel" class="bet_panel input_panel bet_closed">
			@include('home.tema')
		</div>
	</div>
	
	@include('home.kuaijie_tema')
	<div style="clear:both;"></div>
</div>


<div class="L_HK6 P_tm skin_red lhc_center">
	<div id="main">
    	<div id="header">
            <div class="control n_anniu">
            	<div class="buttons">
            		<input id="bet_button" value="下单" class="resetbtn button" type="button" onclick="submitBetForm(this)"></div>
       		</div></div></div>
</div>		

	
<script type="text/javascript">

<?php echo "var kuaujie = ".json_encode($rs).";"; ?>

var sheng_xiao = ["羊","猴","鸡","狗","猪","鼠","牛","虎","兔","龙","蛇","马"];
$(function () {
	createPingMa ();
	createTeMa ();

	$("#pingma_table td").click(function(){
		var clazz = "sple-select";
// 		alert($(this).find("input").attr("name")+"=="+$(this).hasClass(clazz));
		
		var index = $(this).attr("data");
		var input = $("#pingma_table input[data='"+index+"']");
		if (input.attr("select")=="selected") {
			
		}else {
			
        	var money = $("#pingma_input_money").val();
        	
        	var label_name = "pingma_label_td"+index;
        	var val_name = "pingma_val_td"+index;
        	var label_td = $("#pingma_table td[name='"+label_name+"']");
        	var val_td = $("#pingma_table td[name='"+val_name+"']");
        	
        	if($(this).hasClass(clazz)){
        		
        		label_td.removeClass(clazz);
        		val_td.removeClass(clazz);
        		input.val("");
        		input.attr("select","");
        	}else {
        		label_td.addClass(clazz);
        		val_td.addClass(clazz);
        		input.val(money);
        	}
		}
		if ($(this).find("input").attr("name")&&$(this).hasClass(clazz)){
			$(this).find("input").attr("select","a");
		}
	});
	$("#tema_table td").click(function(){
		var money = $("#tema_input_money").val();
		var index = $(this).attr("data");
		var label_name = "tema_label_td"+index;
		var val_name = "tema_val_td"+index;
		var label_td = $("#tema_table td[name='"+label_name+"']");
		var val_td = $("#tema_table td[name='"+val_name+"']");
		var input = $("#tema_table input[data='"+index+"']");
		
		var clazz = "sple-select";
		
		if($(this).hasClass(clazz)){
			
			label_td.removeClass(clazz);
			val_td.removeClass(clazz);
			input.val("");
		}else {
			label_td.addClass(clazz);
			val_td.addClass(clazz);
			input.val(money);
		}
	});
});

function clickMoneyInput (obj) {

	var td = $(obj).parent();
	var name = "pingma_val_td"+$(obj).attr("data");
	if (td.hasClass("sple-select")&&td.attr("name")==name) {
		$(obj).attr("select","selected");
	}
	
}

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
function createItem (index,type) {

	var rs = ['<td class="GTM GTM0 name" name="'+type+'_label_td'+index+'" data="'+index+'">'];
	if (index>=10) {
		rs.push('<span class="b'+index+'"></span></td>');
	}else {
		rs.push('<span class="b0'+index+'"></span></td>');
	}
	var sx = sheng_xiao[index%12];
	rs.push('<td name="'+type+'_label_td'+index+'" data="'+index+'">'+sx+'</td>');
	rs.push('<td class="GTM GTM0 amount ha" name="'+type+'_val_td'+index+'" data="'+index+'">');
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
    	"onclick=\"clickMoneyInput(this)\"",
    	
    	'class="tmthis ba" maxlength="6" code="'+code+'" name="'+type+'_money[]"',
    	'sx="'+sx+'"',
    	'data="'+code+'"',
    	'type="'+type+'">'
	].join("");
}


function submitBetForm (obj) {

	$(obj).atrr("disabled","disabled");

	var haomas = {"code":"{{$currGameResult->code or '' }}"};
	var tema_haomas = [];
	$("#tema_table input").each(function(){
		var inp = $(this);
		var money = inp.val();
		var code = inp.attr("code");
		var sx = inp.attr("sx")
		
		if (money.length > 0) {
			var haoma = {};
			haoma["money"] = money;
			haoma["sx"] = sx;
			haoma["code"] = code;
			tema_haomas.push(haoma);
		}
	});
	haomas["tema"] = tema_haomas;


	var pingma_haomas = [];
	$("#pingma_table input").each(function(){
		var inp = $(this);
		var money = inp.val();
		var code = inp.attr("code");
		var sx = inp.attr("sx")
		
		if (money.length > 0) {
			var haoma = {};
			haoma["money"] = money;
			haoma["sx"] = sx;
			haoma["code"] = code;
			pingma_haomas.push(haoma);
		}
	});
	
	haomas["pingma"] = pingma_haomas;

	$.ajax({
        type: "POST",
        dataType: "json",
        url: "{{ route('home.bet') }}",
        data: {"haomas":haomas},
        success: function (data) {
            if (data.code=="1") {
            	alert(data.msg);
                if (data.url) {
                	self.location=data.url; 
                }
            }else {
            	alert(data.msg);
            }
        }
    });
}
<!--

//-->
</script>
@endsection

