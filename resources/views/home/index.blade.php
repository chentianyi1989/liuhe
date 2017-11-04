@extends('home.main')

@section('content')

<div class="L_HK6 P_tm skin_red lhc_center">
    <div id="main">
        <div id="bet_panel" class="bet_panel input_panel bet_closed">
             @include('home.pingma')
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
		
	
<div class="L_HK6 P_tm skin_red lhc_center">
	<div id="main">
		<div id="bet_panel" class="bet_panel input_panel bet_closed">
			@include('home.tema')
		</div>
	</div>
	
	@include('home.kuaijie')
	<div style="clear:both;"></div>
</div>



<div class="L_HK6 P_tm skin_red lhc_center">
	<div id="main">
	<div id="header">
        <div class="control n_anniu">
        	<div class="buttons">
            	<input value="确定" class="button commitbtn" type="button" onclick="sureBetForm()">
        		<input value="下单" class="resetbtn button" type="button" onclick="submitBetForm()"></div>
   		</div></div>
    	<table class="table_ball">
    		<thead>
				<tr>
					<th>期数</th>
					<th>类型</th>
					<th>号码</th>
					<th>金额</th>	
				</tr></thead>
			<tbody>
				<tr>
					<th rowspan="4"><strong>第&nbsp;&nbsp;
						<span id="current_issue" class="color-green">{{$currGameResult->code}}</span>&nbsp;&nbsp;期</strong></th>
					<th>平码</th>
					<td id=""></td>
					<td></td>
				</tr>
				<tr>
					<th>特码</th>
					<td id="tema_show_haoma"></td>
					<td></td>
				</tr>
				
				
            </tbody></table></div>
</div>		

	
<script type="text/javascript">
function sureBetForm() {
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

	var tema_table = $("<table>");
	for (var i in tema_haomas) {
		var hm = tema_haomas[i];
		var tr = $("<tr>");
		var td_code = "<td>"+hm["code"]+"</td>";
		tr.append(td_code);
		var td_sx = "<td>"+hm["sx"]+"</td>";
		tr.append(td_sx);
		var td_money = "<td>"+hm["money"]+"</td>";
		tr.append(td_money);
		tema_table.append(tr);
	}

	$("#tema_show_haoma").text("");
	$("#tema_show_haoma").append(tema_table);
	
}

function submitBetForm () {

	var haomas = {"code":"{{$currGameResult->code}}"};
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
            alert(data.msg+data.url);
            if (data.url) {
            	self.location=data.url; 
            }
        },
        error: function(data) {
            alert("error:"+data.responseText);
         }
    });
}
<!--

//-->
</script>
@endsection

