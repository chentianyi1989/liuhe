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

</script>


<div>
	<form method="post" action="{{ route('members.logMoney.list') }}">
    	<table>
    		<tr>
    			<td width="80px">用户名：</td>
    			<td width="200px"><input id="username" /></td>
    			
    		</tr>
    		
    	</table>
	</form>

	<div style="text-align:left;padding:5px">
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="searchForm(this)">查询</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearSearchUserForm()">清空</a>
    </div>
</div>
<table id="dataList" >
	<thead>
		<tr>
			<th data-options="field:'id'" width="5%">ID</th>
			<th data-options="field:'member_id'" width="15%">用户名</th>
			<th data-options="field:'info'" width="15%">信息</th>
			<th data-options="field:'money'" width="15%">金额</th>
			<th data-options="field:'game_record_id'" width="15%">游戏记录</th>
			<th data-options="field:'created_at'" width="15%">时间</th>
		</tr>
	</thead>
</table>







	


