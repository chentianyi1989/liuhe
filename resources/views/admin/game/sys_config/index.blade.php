<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">
	function a() {
		
	}
</script>

<table id="dataList" >
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

<form action="{{ route('game.game.sysConfig.update') }}" method="post">
    <table>
    
    	<tr>
    		<td>标题</td>
    		<td><input name="title" value="{{ $sys_config->title }}"/></td>
    	</tr>
    	<tr>
    		<td>公告</td>
    		<td><textarea rows="6" cols="14" name="note">{{ $sys_config->note }}</textarea></td>
    	</tr>
    	<tr>
    		<td>状态</td>
    		<td><input name="state" value="{{ $sys_config->state }}"/></td>
    	</tr>
    	<tr>
    		<td>开盘时间：</td><td><input name="open_at" value="{{ $sys_config->start_at }}"/></td>
    	</tr>
    	<tr>
    		<td>关盘时间：</td><td><input name="end_at" value="{{ $sys_config->end_at }}"/></td>
    	</tr>
    	<tr>
    		<td>开盘间隔：</td><td><input name="step" value="{{ $sys_config->step }}"/></td>
    	</tr>
    	
    </table>
    	<input type="button" value="修改" onclick=""/>
</form>









