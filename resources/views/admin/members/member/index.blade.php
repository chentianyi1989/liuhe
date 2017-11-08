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
		singleSelect:true
		
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

function openUpdateUser() {
	
	var row = $('#dataList').datagrid('getSelected');
	
	if(row) {
		$("#div_updateUser input[name='name']").val(row.name);
		$("#div_updateUser input[name='phone']").val(row.phone);
		$("#div_updateUser input[name='id']").val(row.id);
		var title = "修改用户："+row.username;
		$("#div_updateUser").window({"title":title}).window('open');
		
	}else {
		alert("请先选择一条记录");
	}
}

function closeUpdateUser() {
	$("#div_updateUser").window('close');
}

function submitupdateUserForm (obj) {

	var form = $(obj).parents('form');
	form.form('submit',{
		onSubmit:function(){
		},
	 	success:function(data){
			data = eval('(' + data + ')');  
			if (data["code"]==0) {
				searchForm ();
				form.form('clear');
				
			}else if(data["code"]==1) {

				alert(data["msg"]);
			}else if (data["code"]==99) {
				clearAddUserForm();
				closeAddUser();
			}
		}
	});
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
    	
    	<a href="#" onclick="openRecharge()" class="easyui-linkbutton" data-options="iconCls:'icon-add'">充值</a>
    	<a href="#" onclick="openWithdrawal()" class="easyui-linkbutton" data-options="iconCls:'icon-add'">提现</a>
    	
    	<a href="#" onclick="openAddUser()" class="easyui-linkbutton" data-options="iconCls:'icon-add'">添加用户</a>
    	<a href="#" onclick="openUpdateUser()" class="easyui-linkbutton" data-options="iconCls:'icon-add'">修改用户</a>
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
		<div style="text-align:center;padding:5px">
        	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitAddUserForm()">提交</a>
        	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearAddUserForm()">清空</a>
        	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeAddUser()">关闭</a>
        </div>
	</form>
	
</div>

<div id="div_updateUser" class="easyui-window" title="修改用户"
    data-options="inline:true,modal:true,closed:true,iconCls:'icon-save'" 
    style="width:800px;height:400px;padding:10px;top:100px;">

	<form id="form_updateUser" method="post" action="{{ route('members.member.update') }}">
		<input type="hidden" name="id">
		<table cellpadding="5">
			<tr>
				<td>用户名:</td>
				<td></td>
			</tr>
			<tr>
				<td>姓名:</td>
				<td>
					<input type="text" name="name"/>
				</td>
			</tr>
			<tr>
				<td>电话:</td>
				<td><input type="text" name="phone"
					/></td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><input type="text" name="password"
					/></td>
			</tr>
		</table>
		<div style="text-align:center;padding:5px">
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitupdateUserForm(this)">提交</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm(this)">清空</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeUpdateUser()">关闭</a>
    </div>
	</form>
</div>


<table id="dataList" >
	<thead>
		<tr>
			<th data-options="field:'id'" width="5%">ID</th>
			<th data-options="field:'username'" width="15%">用户名</th>
			<th data-options="field:'name'" width="15%">姓名</th>
			<th data-options="field:'money'" width="15%">余额</th>
			<th data-options="field:'phone'" width="15%">电话</th>
			<th data-options="field:'state'" width="15%">状态</th>
			<th data-options="field:'created_at'" width="15%">注册时间</th>
		</tr>
	</thead>
</table>







	


