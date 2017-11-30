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
        		</tr>
        		@foreach($pingmas as $pm)
        			<tr>
        				<td>{{$pm['code']}}</td>
        				<td>{{$pm['money']}}</td>
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
        		</tr>
        		@foreach($temas as $tm)
        			<tr>
        				<td>{{$tm['code']}}</td>
        				<td>{{$tm['money']}}</td>
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

	$(function () {
		$(":input[id*='rs_pm']").blur (function() {
			var inp = $(this);
			if (inp.val()) {
				var index = inp.attr('name');
				var pingma = _pingmas[inp.val()];
				var money = pingma['money'];
				var payout = money * 6;
				var rate = 0;
				if(_pingma_money!=0){
					rate = payout/_pingma_money;
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
				var payout = money * 40;
				var rate = 0;
				if(_pingma_money!=0){
					rate = payout/_tema_money;
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
			total_rate = total_payout/_total_money
		}   
		$("#total_rate").html(total_rate);
	}
	
</script>
<div style="padding-left: 20px;display:inline-block;" >
	<form>
	<table>
		<tr>
			<td>特码：<input id='rs_tm'></td>
			<td>平码：<input id="rs_pm1" name="1">
					<input id='rs_pm2' name="2">
					<input id='rs_pm3' name="3">
					<input id='rs_pm4' name="4">
					<input id='rs_pm5' name="5">
					<input id='rs_pm6' name="6"></td>
			<td><input type="button" onclick="" value="提交"/></td>
		</tr>
	</table>
	</form>
	结果：<br/>
	<table>
		<tr>
			<td>总金额：{{$total_money}}</td><td>特码总金额：{{$temas_money}}</td><td>平码总金额：{{$pingmas_money}}</td>
		</tr>
		<tr>
			<td>总派彩金额：<span id="total_payout"></span></td><td>总赔率：<span id="total_rate"></span></td>
		</tr>
		<tr>
			<td colspan="3">
				<table>
					<tr>
						<td>特码：<b id="tema_code"></b><br/>
                        	下注金额：<b id="tema_money"></b><br/>
                        	派彩金额：<b id="tema_payout"></b><br/>
                        	赔率：<b id="tema_rate"></b><br/></td>
					</tr>
					<tr>
						<td>
							平码：<br/>
                        	<table>
                        		<tr>
                        			<td>1：<b id="pingma_code1"></b></td>
                        			<td>下注金额：<b id="pingma_money1"></b></td>
                        			<td>派彩金额：<b id="pingma_payout1"></b></td>
                        			<td>赔率：<b id="pingma_rate1"></b></td></tr>
                        		<tr>
                        			<td>2：<b id="pingma_code2"></b></td>
                                    <td>下注金额：<b id="pingma_money2"></b></td>
                                    <td>派彩金额：<b id="pingma_payout2"></b></td>
                                    <td>赔率：<b id="pingma_rate2"></b></td></tr>
                                <tr>
                        			<td>3：<b id="pingma_code3"></b></td>
                                    <td>下注金额：<b id="pingma_money3"></b></td>
                                    <td>派彩金额：<b id="pingma_payout3"></b></td>
                                    <td>赔率：<b id="pingma_rate3"></b></td></tr>
                        		<tr>
                        			<td>4：<b id="pingma_code4"></b></td>
                                    <td>下注金额：<b id="pingma_money4"></b></td>
                                    <td>派彩金额：<b id="pingma_payout4"></b></td>
                                    <td>赔率：<b id="pingma_rate4"></b></td></tr>
                        		<tr>
                        			<td>5：<b id="pingma_code5"></b></td>
                                    <td>下注金额：<b id="pingma_money5"></b></td>
                                    <td>派彩金额：<b id="pingma_payout5"></b></td>
                                    <td>赔率：<b id="pingma_rate5"></b></td></tr>
                        		<tr>
                        			<td>6：<b id="pingma_code6"></b></td>
                                    <td>下注金额：<b id="pingma_money6"></b></td>
                                    <td>派彩金额：<b id="pingma_payout6"></b></td>
                                    <td>赔率：<b id="pingma_rate6"></b></td></tr>
                        	</table></td>
                        	<td>
                        		下注金额：<br/>
                        		派彩金额：<br/>
                        		赔率：<br/>
                        	</td>
					</tr>
				</table>
		</tr>
		<tr>
        	
		</tr>
	</table>
</div>








