<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">
<!--

$(function () {
	initBallInt();

	
});

function initBallInt() {
	$("#dataList").datagrid({
		url:"{{ route('members.member.list') }}",
		loadMsg: '数据加载中,请稍候...',
		pagination: true,
		
	}); 
	
}


var zodiac = {
@foreach(config('ball.zodiac') as $k => $v)
	"{{$k}}":"{{$v}}",
@endforeach
};


var colour = {
@foreach(config('ball.colour') as $k => $v)
	"{{$k}}":"{{$v}}",
@endforeach
};

function initZodiac (val,row) {
	return zodiac[val];
}

function initColour (val,row) {
	return colour[val];
}
//-->


function openAddUser (){


	$("#div_addUser").window('open');

}

function closeAddUser () {
	$("#div_addUser").window('close');
}

function submitAddUserForm(){
	$('#form_addUser').form('submit',{
		onSubmit:function(){
			return $(this).form('enableValidation').form('validate');
		},
	 	success:function(data){
			alert(data);
			data = eval('(' + data + ')');  
			
			if (data["code"]==0) {
				searchForm ();
				clearAddUserForm();
				closeAddUser();
				
			}else if(data["code"]==1) {

				alert(data["msg"]);
			}else if (data["code"]==99) {
				clearAddUserForm();
				closeAddUser();
			}
		}
	});
}
function clearAddUserForm(){
	$('#form_addUser').form('clear');
}
// 查询
function searchForm (){
	
	$("#dataList").datagrid('load',{
		"username":$("#username").val(),
		"name":$("#name").val(),
	});
}
function clearSearchUserForm(){
	$('#form_searchUser').form('clear');
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
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearSearchUserForm()">清空</a>
    	<a href="#" onclick="openAddUser()" class="easyui-linkbutton" data-options="iconCls:'icon-add'">添加用户</a>
    </div>
</div>





<div id="div_addUser" class="easyui-window" title="添加用户"
    data-options="inline:true,modal:true,closed:true,iconCls:'icon-save'" 
    style="width:800px;height:400px;padding:10px;top:100px;">

	<form id="form_addUser" method="post" action="{{ route('members.member.add') }}">
		<table cellpadding="5">
			<tr>
				<td>用户名:</td>
				<td><input class="easyui-textbox" type="text" name="username"
					data-options="required:true"/></td>
			</tr>
			<tr>
				<td>姓名:</td>
				<td><input class="easyui-textbox" type="text" name="name"
					data-options="required:true"/></td>
			</tr>
		</table>
	</form>
	<div style="text-align:center;padding:5px">
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitAddUserForm()">提交</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearAddUserForm()">清空</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeAddUser()">关闭</a>
    </div>
</div>






<table id="dataList" >
	<thead>
		<tr>
			<th data-options="field:'id'" width="5%">ID</th>
			<th data-options="field:'username'" width="15%">用户名</th>
			<th data-options="field:'name'" width="15%">姓名</th>
			<th data-options="field:'money'" width="15%">余额</th>
			<th data-options="field:'state'" width="15%">状态</th>
			<th data-options="field:'created_at'" width="15%">注册时间</th>
		</tr>
	</thead>
</table>







	


