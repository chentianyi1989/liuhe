
@extends('admin.template')

@section('content')

<div class="cl pd-5 bg-1 bk-gray mt-20">
	<span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i>
			删除</a> 
		<a href="javascript:;" onclick="member_edit()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>
			修改</a>
		<a href="javascript:;" onclick="member_add()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>
			添加</a>
	</span> 
	<span class="r">共有数据：<strong>88</strong> 条 </span>
</div>

<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort" id="tableList">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">标题</th>
				<th width="40">大类</th>
				<th width="100">小类</th>
			</tr>
		</thead>
		<tbody>
			@foreach($beans as $item)
			<tr class="text-c">
				<td><input type="checkbox" value="{{ @$item->id}}"></td>
				<td>{{ @$item->id}}</td>
				<td>{{ @$item->title }}</td>
				<td>{{ @config('sys.inform_fenlei')[@$item->dalei]["name"] }}</td>
				<td>{{ @config('sys.inform_fenlei')[@$item->dalei]["child"][@$item->xiaolei] }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


@endsection 


@section('mate.js') 
<script type="text/javascript">

function member_add(){

	var url = "{{ route('information.edit') }}";
	layer_show("添加资讯"+url,url,500);
}

function member_edit(){

	var checkbox = $("#tableList").find("input[type='checkbox']:checked");
	if (checkbox.length < 1) {
		alert("选择一条记录");
		return ""
	}else if (checkbox.length > 1){
		alert("只能选择一条记录");
		return ""
	}
	var id = checkbox.val();
	var url = "{{ route('information.edit') }}?id="+id;
	layer_show("修改装修案例"+url,url,500);
}


function datadel () {
	var checkbox = $("#tableList").find("input[type='checkbox']:checked");
	if (checkbox.length < 1) {
		alert("选择一条记录");
		return ""
	}else if (checkbox.length > 1){
		alert("只能选择一条记录");
		return ""
	}
	var id = checkbox.val();
	var url = "{{ route('information.delete') }}?id="+id;

	$.ajax({
		type:"GET",
        url:url,
        dataType:"json",
        success:function(req){
            alert("删除成功");
            location.replace(location.href);
        }
	});
}
</script>

@endsection 


@section('breadcrumb')
<i class="Hui-iconfont">&#xe67f;</i> 
	首页 
	<span class="c-gray en">&gt;</span>
	资讯管理 
	<span class="c-gray en">&gt;</span> 资讯列表
@endsection

