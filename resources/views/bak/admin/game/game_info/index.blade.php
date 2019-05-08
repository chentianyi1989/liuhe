@include('admin.layouts.context')
<script type="text/javascript">


</script>

<div >
	<span style="float: left;">
		<p>平码</p>
        <table id="dataList" border="1" >
        	<thead>
        		<tr>
        			<th width="50">号码</th>
        			<th width="80">金额</th>
        			<th width="80">输赢</th>
        		</tr>
        		@foreach($pingmas as $pm)
        			<tr>
        				<td>{{$pm['code']}}</td>
        				<td>{{$pm['money']}}</td>
        				<td><?php 
        				    if ($pingmas_money){
        				        echo $pingmas_money - $pm['money'] * config('admin.pingma_odds');
            				}else {
            				    echo 0;
            				}
        				    ?>
        				</td>
        			</tr>
        		@endforeach
        	</thead>
        </table>
    </span>
    <span style="float: left;">
    	<p>特码</p>
        <table id="dataList" border="1">
        	<thead>
        		<tr>
        			<th width="50">号码</th>
        			<th width="80">金额</th>
        			<th width="80">输赢</th>
        		</tr>
        		@foreach($temas as $tm)
        			<tr>
        				<td>{{$tm['code']}}</td>
        				<td>{{$tm['money']}}</td>
        				<td>
        					<?php 
            				    if ($temas_money){
            				        echo $temas_money - $tm['money']*config('admin.tema_odds');
                				}else {
                				    echo 0;
                				}
        				    ?>
        				</td>
        			</tr>
        		@endforeach
        	</thead>
        </table>
    </span>
</div>
<script type="text/javascript">
	var _temas = <?php echo json_encode($temas)?>;
	var _pingmas = <?php echo json_encode($pingmas)?>;
	var _total_money = {{$total_money}};
	var _pingma_money = {{$pingmas_money}};
	var _tema_money = {{$temas_money}};
	var _pingma_odds = {{ config('admin.pingma_odds') }};
	var _tema_odds = {{ config('admin.tema_odds') }};
	$(function () {
		$(":input[id*='rs_pm']").blur (function() {
			var inp = $(this);
			if (inp.val()) {
				var index = inp.attr('data');
				var pingma = _pingmas[inp.val()];
				var money = pingma['money'];
				var payout = money * _pingma_odds;
				var rate = 0;
				if(_pingma_money!=0){
					rate = _pingma_money-payout;
				}
				var code = pingma['code'];

				$("#pingma_code"+index).html(code);
				$("#pingma_money"+index).html(money);
				$("#pingma_payout"+index).html(payout);
				$("#pingma_rate"+index).html(rate);

				sss ();
			}
		});
		$(":input[id*='rs_tm']").blur (function() {
			var inp = $(this);
			if (inp.val()) {
				var tema = _temas[inp.val()];
				var money = tema['money'];
				var payout = money * _tema_odds;
				var rate = 0;
				if(_pingma_money!=0){
					rate = _tema_money - payout;
				}
				var code = tema['code'];
				$("#tema_code").html(code);
				$("#tema_money").html(money);
				$("#tema_payout").html(payout);
				$("#tema_rate").html(rate);
				sss ();
			}
		});
	});

	function sss () {
		var total_payout = 0;
		$("b[id*='payout']").each(function(){
			var i = $(this);
			try {
				total_payout += Number(i.html());
			}catch (e) {
			}
		});
		$("#total_payout").html(total_payout);
		var total_rate = 0;
		if (_total_money!=0) {
			total_rate = _total_money - total_payout;
		}   
		$("#total_rate").html(total_rate);
	}
	
	function submitForm (obj) {
		
		$(obj).parents("form").form('submit',{
			onSubmit:function(){

				var v0 = $("#rs_tm").val();
				if (v0 == "") {
					alert("特码不能为空！");
					return false;
				}

				var v1 = $("#rs_pm1").val();
				var v2 = $("#rs_pm2").val();
				var v3 = $("#rs_pm3").val();
				var v4 = $("#rs_pm4").val();
				var v5 = $("#rs_pm5").val();
				var v6 = $("#rs_pm6").val();


				var arr = [v0,v1,v2,v3,v4,v5,v6];

				for (var i in arr) {

					if (arr[i] == "") {
						alert("平码"+i+"没有填写号码");
						return false;
					}
					
					for (var j in arr) {
						if (arr[i] == arr[j] && j!=i) {
							alert("有重复号码！");
							return false;
						}	
					}
				}
				
				return true;
				
			},
		 	success:function(data){
				data = eval('(' + data + ')');  
				if(data["code"]=='1') {
					alert(data["msg"]);
					
				}else if (data["code"]=='99') {
					alert(data["msg"]);
				}
			}
		});	
	}
	
</script>
<div style="padding-left: 20px;display:inline-block;" >
	<form action="{{ route('game.info.updateGameResult')}}" method="post">
		期数：<input name="code" value="{{ $currGameResult->code}}" readonly="readonly"/>
	<table>
		<tr>
			<td>特码：<input id='rs_tm' name="tema" value="{{ $currGameResult->tema_result}}"></td>
			<td>平码：<input id="rs_pm1" name="pingma[]" data="1" value="{{ $pingma_result[0] or ''}}">
					<input id='rs_pm2' name="pingma[]" data="2" value="{{ $pingma_result[1] or ''}}">
					<input id='rs_pm3' name="pingma[]" data="3" value="{{ $pingma_result[2] or ''}}">
					<input id='rs_pm4' name="pingma[]" data="4" value="{{ $pingma_result[3] or ''}}">
					<input id='rs_pm5' name="pingma[]" data="5" value="{{ $pingma_result[4] or ''}}">
					<input id='rs_pm6' name="pingma[]" data="6" value="{{ $pingma_result[5] or ''}}"></td>
			<td><input type="button" onclick="submitForm(this)" value="提交"/></td>
		</tr>
	</table>
	</form>
	平码赔率：{{config('admin.pingma_odds')}}，特码赔率{{config('admin.tema_odds')}}<br/>
	结果：<br/>
	<table>
		<tr>
			<td>总金额：{{$total_money}}</td><td>特码总金额：{{$temas_money}}</td><td>平码总金额：{{$pingmas_money}}</td>
		</tr>
		<tr>
			<td>总派彩金额：<span id="total_payout"></span></td><td>总输赢：<span id="total_rate"></span></td>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td>特码：<b id="tema_code"></b><br/>
                        	下注金额：<b id="tema_money"></b><br/>
                        	派彩金额：<b id="tema_payout"></b><br/>
                        	输赢：<b id="tema_rate"></b><br/></td>
					</tr>
					<tr>
						<td>
							平码：<br/>
                        	<table>
                        		<tr>
                        			<td>1：<b id="pingma_code1"></b></td>
                        			<td>下注金额：<b id="pingma_money1"></b></td>
                        			<td>派彩金额：<b id="pingma_payout1"></b></td>
                        			<td>输赢：<b id="pingma_rate1"></b></td></tr>
                        		<tr>
                        			<td>2：<b id="pingma_code2"></b></td>
                                    <td>下注金额：<b id="pingma_money2"></b></td>
                                    <td>派彩金额：<b id="pingma_payout2"></b></td>
                                    <td>输赢：<b id="pingma_rate2"></b></td></tr>
                                <tr>
                        			<td>3：<b id="pingma_code3"></b></td>
                                    <td>下注金额：<b id="pingma_money3"></b></td>
                                    <td>派彩金额：<b id="pingma_payout3"></b></td>
                                    <td>输赢：<b id="pingma_rate3"></b></td></tr>
                        		<tr>
                        			<td>4：<b id="pingma_code4"></b></td>
                                    <td>下注金额：<b id="pingma_money4"></b></td>
                                    <td>派彩金额：<b id="pingma_payout4"></b></td>
                                    <td>输赢：<b id="pingma_rate4"></b></td></tr>
                        		<tr>
                        			<td>5：<b id="pingma_code5"></b></td>
                                    <td>下注金额：<b id="pingma_money5"></b></td>
                                    <td>派彩金额：<b id="pingma_payout5"></b></td>
                                    <td>输赢：<b id="pingma_rate5"></b></td></tr>
                        		<tr>
                        			<td>6：<b id="pingma_code6"></b></td>
                                    <td>下注金额：<b id="pingma_money6"></b></td>
                                    <td>派彩金额：<b id="pingma_payout6"></b></td>
                                    <td>输赢：<b id="pingma_rate6"></b></td></tr>
                        	</table></td>
					</tr>
				</table>
		</tr>
	</table>
</div>








