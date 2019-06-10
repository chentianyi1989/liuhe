
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
				<th width="100">账号</th>
				<th width="40">姓名</th>
				<th width="100">图像</th>
				<th width="100">角色</th>
				<th width="90">职称</th>
				<th width="150">经验</th>
				<th width="40">介绍</th>
<!-- 				<th width="">学习经历</th> -->
<!-- 				<th width="100">设计理念</th> -->
			</tr>
		</thead>
		<tbody>
			@foreach($members as $item)
			<tr class="text-c">
				<td><input type="checkbox" value="{{ @$item->id}}"></td>
				<td>{{ @$item->id}}</td>
				<td>{{ @$item->username }}</td>
				<td>{{ @$item->name }}</td>
				<td><?php 
// 				$ts = json_decode($item->tuxiang,true);
				?>
					<img width="100" class="picture-thumb" src="{{ @$item->tuxiang }}">
				</td>
				<td>{{ @config('sys.role')[$item->juese] }}</td>
				
				<td>{{ @$item->zhicheng }}</td>
				<td>{{ @$item->jingyan }}</td>
				<td>{{ @$item->jieshao }}</td>
				
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


@endsection 


@section('mate.js') 
<script type="text/javascript">

function member_add(){

	var url = "{{ route('member.edit') }}";
	layer_show("添加员工"+url,url,500);
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
	var url = "{{ route('member.edit') }}?id="+id;
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
	var url = "{{ route('member.delete') }}?id="+id;

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
	用户中心 
	<span class="c-gray en">&gt;</span> 用户管理
@endsection

