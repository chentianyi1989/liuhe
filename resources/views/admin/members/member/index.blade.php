<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">


$(function () {
	initUserInt();

	
});

function initUserInt() {
	$("#dataList").datagrid({
		url:"{{ route('members.member.list') }}",
		loadMsg: '数据加载中,请稍候...',
		pagination: true,
		singleSelect:true
		
	}); 
}

function submitWindow (obj) {
	var form = $(obj).parents('form');
	form.form('submit',{
		onSubmit:function(){
		},
	 	success:function(data){
			data = eval('(' + data + ')');  
			if(data["code"]=='1') {
				searchForm ();
				form.form('clear');
				alert(data["msg"]);
				form.parents('div').window('close');
				
			}else if (data["code"]=='99') {
				alert(data["msg"]);
			}
		}
	});	
}
function closeWindow (obj) {
	$(obj).parents('form').parents('div').window('close');
}
function clearForm(obj) {
	$(obj).parents('form').form('clear');
}
function openRecharge (){

	var row = $('#dataList').datagrid('getSelected');
	
	if(row) {
		$("#div_rechargeUser input[name='id']").val(row.id);
		$("#div_rechargeUser").window('open');
		
	}else {
		alert("请先选择一条记录");
	}
}

function openWithdrawal (){
	
	var row = $('#dataList').datagrid('getSelected');
	if(row) {
		$("#div_withdrawalUser input[name='id']").val(row.id);
		$("#div_withdrawalUser").window('open');
	}else {
		alert("请先选择一条记录");
	}
}

function openAddUser (){
	$("#div_addUser").window('open');
}

function openUpdateUser() {
	
	var row = $('#dataList').datagrid('getSelected');
	
	if(row) {
		$("#div_updateUser input[name='name']").val(row.name);
		$("#div_updateUser input[name='phone']").val(row.phone);
		$("#div_updateUser input[name='id']").val(row.id);
		$("#div_updateUser input[name='username']").val(row.username);
		var title = "修改用户："+row.username;
		$("#div_updateUser").window({"title":title}).window('open');
		
	}else {
		alert("请先选择一条记录");
	}
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
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="searchForm(this)">查询</a>
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
        	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitWindow(this)">提交</a>
        	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm(this)">清空</a>
        	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeWindow(this)">关闭</a>
        </div>
	</form>
	
</div>

<div id="div_updateUser" class="easyui-window" title="修改用户"
    data-options="inline:true,modal:true,closed:true,iconCls:'icon-save'" 
    style="width:800px;height:400px;padding:10px;top:100px;">

	<form id="form_updateUser" method="post" action="{{ route('members.member.update') }}">
		<input type="hidden" name="id">
		<input type="hidden" name="username">
		<table cellpadding="5">
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
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitWindow(this)">提交</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm(this)">清空</a>
    	<a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeWindow(this)">关闭</a>
    </div>
	</form>
</div>

<div id="div_rechargeUser" class="easyui-window" title="用户充值"
    data-options="inline:true,modal:true,closed:true,iconCls:'icon-save'" 
    style="width:800px;height:400px;padding:10px;top:100px;">
	
	<form method="post" action="{{ route('members.member.recharge') }}">
		<input type="hidden" name="id">
		<table cellpadding="5">
			<tr>
				<td>充值金额:</td>
				<td><input type="text" name="money"/></td>
			</tr>
			<tr>
				<td>备注:</td>
				<td><input type="text" name="info"/></td>
			</tr>
		</table>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitWindow(this)">提交</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeWindow(this)">关闭</a>
	</form>
</div>

<div id="div_withdrawalUser" class="easyui-window" title="用户取现"
    data-options="inline:true,modal:true,closed:true,iconCls:'icon-save'" 
    style="width:800px;height:400px;padding:10px;top:100px;">
	
	<form method="post" action="{{ route('members.member.withdrawal') }}">
		<input type="hidden" name="id">
		<table cellpadding="5">
			<tr>
				<td>取现金额:</td>
				<td><input type="text" name="money"/></td>
			</tr>
			<tr>
				<td>备注:</td>
				<td><input type="text" name="info"/></td>
			</tr>
		</table>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitWindow(this)">提交</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="closeWindow(this)">关闭</a>
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







	


