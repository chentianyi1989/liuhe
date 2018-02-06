<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">
$(function () {
	$("#dataList").datagrid({
		url:"{{ route('members.gameRecord.list') }}",
		loadMsg: '数据加载中,请稍候...',
		pagination: true,
		
	}); 
});


function formatMemberUsername (val,row){
	return row.member.username;
}
function formatMemberName (val,row){
	return row.member.name;
}

//查询
function searchForm (){
	
	$("#dataList").datagrid('load',{
		"username":$("#username").val(),
		"name":$("#name").val(),
	});
}


function gameRecord (val,row) {

	var jsons = JSON.parse(val);
	if (jsons&&jsons.length > 0) {

		jsons.sort(compare);
		var table = "<table><tr><td>号码</td><td>金额</td><td>生肖</td></tr>$tr</table>";
		
		var ul = "<ul>";
		var trs = "";
		for (var i in jsons) {
			
			var r = jsons[i];
			var tr = "<tr>";
			var td1 = "<td>"+r.code+"</td>";
			var td2 = "<td>"+r.money+"</td>";
			var td3 = "<td>"+r.sx+"</td>";
			tr += td1+td2+td3 +"</tr>";
			trs += tr;
		}
		table = table.replace('$tr',trs);
		return table;
	}
	return "";
}
var compare = function (obj1, obj2) {
    var val1 = parseInt(obj1.code);
    var val2 = parseInt(obj2.code);
    if (val1 < val2) {
        return -1;
    } else if (val1 > val2) {
        return 1;
    } else {
        return 0;
    }            
}
</script>


<div>
	<form id="form_searchUser" method="post" action="">
    	<table>
    		<tr>
    			<td width="80px">用户名：</td>
    			<td width="200px"><input id="username" /></td>
    			<td width="80px">姓名：</td>
    			<td width="200px"><input id="name" /></td>
    		</tr>
    	</table>
	</form>

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
			<th data-options="field:'code'" width="15%">期数</th>
			<th data-options="field:'tema',formatter:gameRecord" width="15%">特码</th>
			<th data-options="field:'pingma',formatter:gameRecord" width="15%">平码</th>
			<th data-options="field:'created_at'" width="15%">时间</th>
		</tr>
	</thead>
</table>







	


