
@extends('admin.template')

@section('content')

<table class="table">
	<tr>
		<td width="200" class="va-t" rowspan="2"><ul id="treeDemo" class="ztree"></ul></td>
		<td class="va-t">
    		<div class="cl pd-5 bg-1 bk-gray mt-20">
            	<span class="l">
            		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i>
            			删除</a> 
            		<a href="javascript:;" onclick="member_edit()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>
            			修改</a>
            		<a href="javascript:;" onclick="member_add()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i>
            			添加</a>
            	</span> 
            	<span class="r"></span>
            </div>
            
		</td>
	</tr>
	<tr>
		<td class="va-t">
    		<iframe ID="testIframe" scrolling="yes" frameborder="0" width=100% height="800px"></iframe>
		</td>
	</tr>
</table>

@endsection 


@section('mate.js') 
<link rel="stylesheet" href="/plugin/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="/plugin/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>

<script type="text/javascript">

var setting = {
	view: {
		dblClickExpand: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
// 				alert(treeNode.file)
				$("#testIframe").attr("src",treeNode.file);
				return false;
			}
		}
	}
};
var zNodes =[
	{ id:1, pId:0, name:"培训资料", open:true},
	{ id:11, pId:1, name:"设计部培训",file:"{{route('learn.lists')}}"},
	{ id:12, pId:1, name:"市场部培训"},
	{ id:13, pId:1, name:"施工部培训"},
];

$(function(){

	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	demoIframe = $("#testIframe");
	//demoIframe.on("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
})


function member_add(){

	var url = "{{ route('learn.edit') }}";
	layer_show("添加培训资源"+url,url,500);
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
	var url = "{{ route('learn.edit') }}?id="+id;
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
	培训管理 
	<span class="c-gray en">&gt;</span> 培训资源
@endsection

