<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">

	function submitForm(obj) {
		var form = $(obj).parents('form');
		form.form('submit',{
			onSubmit:function(){
			},
		 	success:function(data){
				data = eval('(' + data + ')');  
				if(data["code"]=='1') {
					alert(data["msg"]);
					
				}else if (data["code"]=='99') {
					alert(data["msg"]);
				}
			}
		});	
	}
</script>

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
    		<td>开盘时间：</td><td>
    			<input name="start_at" class="Wdate" onfocus="WdatePicker({dateFmt:'HH:00:00',readOnly:true})" value="{{ $sys_config->start_at }}">
    		</td>
    	</tr>
    	<tr>
    		<td>关盘时间：</td><td>
    			<input name="end_at" class="Wdate" onfocus="WdatePicker({dateFmt:'HH:59:59',readOnly:true})" value="{{ $sys_config->end_at }}">
    		</td>
    	</tr>
    	<tr>
    		<td>开盘间隔：</td><td><input name="step" value="{{ $sys_config->step }}"/></td>
    	</tr>
    	
    </table>
    	<input type="button" value="修改" onclick="submitForm(this)"/>
</form>









