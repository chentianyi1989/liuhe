<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">

</script>
<link href="{{asset('/css/page.css')}}" rel="stylesheet">
<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
<form action="{{route('game.game.outcome')}}" method="get">
<table>
	<tr>
		<td width="80px">用户名：</td>
		<td width="200px"><input name="username" value="{{ $username }}"/></td>
		<td width="80px">姓名：</td>
		<td width="200px"><input name="name" value="{{ $name }}"/></td>
		<td width="80px">开始时间：</td>
		<td width="200px"><input name="start_at" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',readOnly:true})" value="{{ $start_at }}"></td>
		<td width="80px">结束时间：</td>
		<td width="200px"><input name="end_at" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',readOnly:true})" value="{{ $end_at }}"/></td>
	</tr>
</table>
<div style="text-align:left;padding:5px">
	<input type="submit" value="查询"/>
</div>
</form>
<table class="gridtable">
	<thead>
		<tr>
			<th >ID</th>
			<th >用户名</th>
			<th >姓名</th>
			<th >金额</th>
			<th >信息</th>
			<th >时间</th>
		</tr>
	</thead>
	<tbody>
		@foreach($logMemberMoney as $gr)
			<tr>
				<td>{{ $gr->id}}</td>
				<td>{{ $gr->member->username}}</td>
				<td>{{ $gr->member->name}}</td>
				<td>{{ $gr->money }}</td>
				<td>{{ $gr->info }}</td>
				<td>{{ $gr->created_at }}</td>
			</tr>
		@endforeach
			<tr>
				
				<td>总派彩</td><td>{{ $total_payout}}</td>
				<td>总下注</td><td>{{ $total_bet}}</td>
				<td>总撤单</td><td>{{ $total_cancelBet}}</td>
			</tr>
	</tbody>
</table>

{{ $logMemberMoney->links() }}








