<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">
$(function () {
	$("#dataList").datagrid({
		url:"{{ route('members.logMoney.list') }}",
		loadMsg: '数据加载中,请稍候...',
		pagination: true,
		
	}); 
});

//查询
function searchForm (){
	
	$("#dataList").datagrid('load',{
		"username":$("#username").val(),
		"name":$("#name").val(),
	});
}
function formatMemberUsername (val,row){
	return row.member.username;
}
function formatMemberName (val,row){
	return row.member.name;
}

</script>

<div>
    	<table>
    		<tr>
    			<td width="80px">用户名：</td>
    			<td width="200px"><input id="username" /></td>
    			<td width="80px">姓名：</td>
    			<td width="200px"><input id="name" /></td>
    		</tr>
    		
    	</table>

	<div style="text-align:left;padding:5px">
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="searchForm()">查询</a>
    </div>
</div>
<table id="dataList" >
	<thead>
		<tr>
			<th data-options="field:'id'" width="5%">ID</th>
			<th data-options="field:'member.username'" formatter="formatMemberUsername" width="15%">用户名</th>
			<th data-options="field:'member.name'" formatter="formatMemberName" width="15%">姓名</th>
			<th data-options="field:'info'" width="15%">信息</th>
			<th data-options="field:'money'" width="15%">金额</th>
			<th data-options="field:'game_record_id'" width="15%">游戏记录</th>
			<th data-options="field:'created_at'" width="15%">时间</th>
		</tr>
	</thead>
</table>







	


