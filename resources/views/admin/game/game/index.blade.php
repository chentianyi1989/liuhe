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
		singleSelect:true,
		url:"{{ route('game.game.list') }}"
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

<div id="tb" style="margin-bottom:5px">
	<a href="#" onclick="" class="easyui-linkbutton" iconCls="icon-cancel" plain="true">修改</a>
	<a href="#" onclick="" class="easyui-linkbutton" iconCls="icon-cancel" plain="true">停用</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-tip" plain="true">启用</a>
</div>


<table id="dataList" toolbar="#tb">
	<thead>
		<tr>
			<th data-options="field:'id'" width="15%">ID</th>
			<th data-options="field:'name'" width="15%">名称</th>
			<th data-options="field:'code'" width="15%">代码</th>
			<th data-options="field:'odds'" width="15%">赔率</th>
			<th data-options="field:'state',formatter:initState" width="25%">状态</th>
		</tr>
	</thead>
</table>










