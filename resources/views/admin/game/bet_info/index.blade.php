<?php


?>

@include('admin.layouts.context')
<script type="text/javascript">

</script>


<table border="1" >
	<thead>
		<tr>
			<th data-options="field:'用户'" width="15%">用户</th>
			<th data-options="field:'投注额'" width="15%">名称</th>
			<th data-options="field:'账号余额'" width="15%">账号余额</th>
		</tr>
		@foreach($gameRecord as $gr)
			<tr>
    			<td>{{$gr->member->username}}</td>
    			<td>{{$gr->money}}</td>
    			<td>{{$gr->member->money}}</td>
			</tr>
		@endforeach
	</thead>
</table>










