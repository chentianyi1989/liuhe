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
		url:"{{ route('game.ball.list') }}"
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
</script>



<table id="dataList" >
	<thead>
		<tr>
			<th data-options="field:'id'" width="15%">ID</th>
			<th data-options="field:'code'" width="15%">号码</th>
			<th data-options="field:'zodiac',formatter:initZodiac" width="15%">生肖</th>
			<th data-options="field:'colour',formatter:initColour" width="15%">波色</th>
			<th data-options="field:'year'" width="25%">年份</th>
		</tr>
	</thead>
</table>










