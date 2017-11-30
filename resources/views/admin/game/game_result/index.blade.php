<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">
<!--

$(function () {
	initGame();

	
});

function initGame() {
	$("#dataList").datagrid({
		loadMsg: '数据加载中,请稍候...',
		pagination: true,
		url:"{{ route('game.gameResult.list') }}"
	}); 
	
}
var state = {
@foreach(config('admin.state') as $k => $v)
	"{{$k}}":"{{$v}}",
@endforeach
};
function initState (val,row) {
	return state[val];
}

//-->

</script>


<table id="dataList" >
	<thead>
		<tr>
			<th data-options="field:'id'" width="15%">ID</th>
			<th data-options="field:'code'" width="15%">期号</th>
			<th data-options="field:'pingma_result'" width="15%">平码结果</th>
			<th data-options="field:'tema_result'" width="15%">特码结果</th>
			<th data-options="field:'created_at'" width="15%">开盘时间</th>
			<th data-options="field:'lottery_at'" width="15%">开奖时间</th>
			
		</tr>
	</thead>
</table>










