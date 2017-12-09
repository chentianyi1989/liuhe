<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">

</script>

<form action="{{ route('game.betInfo')}}" method="get">
用户名：<input name="username" value="{{$username}}"/>
姓名：<input name="name" value="{{$name}}"/>
<button type="submit" onsubmit="">查询</button>
</form>
<table border="1" >
	<thead>
		<tr>
			<th data-options="field:'用户'" width="15%">用户名</th>
			<th data-options="field:'姓名'" width="15%">姓名</th>
			<th data-options="field:'投注额'" width="15%">特码投注额</th>
			<th data-options="field:'投注额'" width="15%">平码投注额</th>
			<th data-options="field:'账号余额'" width="15%">账号余额</th>
		</tr>
		@foreach($members as $member)
			<tr>
    			<td>{{ $member["username"] }}</td>
    			<td>{{ $member["name"] }}</td>
    			<td>
    				<table border="1" cellspacing="0" width="100%">
    					@foreach ($member["tema_balls"] as $key=>$value) 
    					<tr>
							<td>{{ $key }}</td>
							<td>{{ $value }}</td>     					
    					</tr>
    					@endforeach
    				</table>
    			</td>
    			<td>
    				<table border="1" cellspacing="0" width="100%">
    					@foreach ($member["pingma_balls"] as $key=>$value) 
    					<tr>
							<td>{{ $key }}</td>
							<td>{{ $value }}</td>     					
    					</tr>
    					@endforeach
    				</table>
    			</td>
    			
    			<td>{{ $member["money"] }}</td>
			</tr>
		@endforeach
	</thead>
</table>










