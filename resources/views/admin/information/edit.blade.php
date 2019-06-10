<?php 


?>
@extends('admin.form')
@section('content')
<article class="page-container">
	<form action="{{ route('information.save')}}" method="post" class="form form-horizontal" id="myForm" enctype="multipart/form-data">
		<input name="id" value="{{ @$bean->id}}" readonly="readonly">
		
		<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>标题：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<input type="text" class="input-text" value="{{ @$bean->title}}" placeholder="" name="title">
    		</div>
    	</div>
    	
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>时间：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<input type="text" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="created_at" value="{{ @$bean->created_at}}" class="input-text Wdate">
    		</div>
    	</div>
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>缩略图：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<div>
					@if ($bean->tuxiang) 
						<img alt="" src="{{ @$bean->tuxiang }}" width="200">
					@endif
				</div>
    			<span class="btn-upload form-group">
    				
        			<input class="input-text upload-url" type="text" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="tuxiang" class="input-file">
    			</span>
    		</div>
    	</div>

<!--     	<div class="row cl"> -->
<!--     		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>缩略图描述：</label> -->
<!--     		<div class="formControls col-xs-8 col-sm-9"> -->
<!--     			<input type="text" name="tuxiang_name" value="{{ @$bean->tuxiang_name}}" class="input-text"> -->
<!--     		</div> -->
<!--     	</div> -->
    	
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>大类：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<span class="btn-upload form-group">
    				<select class="input-text" name="dalei" onchange="newChildTag(this)" id="dalei">
        				@foreach(config('sys.inform_fenlei') as $k => $v)
        					@if(@$bean->dalei==$k)
        						<option value="{{ $k }}" selected>{{ $v["name"] }}</option>
        					@else
                            	<option value="{{ $k }}" >{{ $v["name"] }}</option>
                            @endif
                        @endforeach
        			</select>
				</span>
    		</div>
    	</div>
    	
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>小类：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<span class="btn-upload form-group">
    			<select class="input-text" name="xiaolei" id="xiaolei">
    				
    			</select></span>
    		</div>
    	</div>
    	
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>副标题：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<textarea type="text" name="content_title" value="{{ @$bean->content_title}}"></textarea>
    		</div>
    	</div>
    	<div class="row cl">
    		<textarea id="editor" style="width:100%;height:400px;">{{ @$bean->content }}</textarea> 
    		
    	</div>
    	
    	<div class="row cl">
    		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
    			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
    		</div>
    	</div>
    </form>
</article>
@endsection

@section('mate.js')
<link href="{{asset('/plugin/webuploader/0.1.5/webuploader.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{asset('/plugin/webuploader/0.1.5/webuploader.js')}}"></script> 
<script type="text/javascript" src="{{asset('/plugin/ueditor/1.4.3/ueditor.config.js')}}"></script> 
<script type="text/javascript" src="{{asset('/plugin/ueditor/1.4.3/ueditor.all.min.js')}}"> </script> 

<script type="text/javascript">

var leixing = <?php echo json_encode(config('sys.inform_fenlei'),true);?>;
var xiaolei = "{{@$bean->xiaolei}}";
function newChildTag(obj) {
	var dl = $(obj).val();
	var xls = leixing[dl]["child"];
	$("#xiaolei").empty();
	for (var i in xls) {

		if (i==xiaolei) {
			$("#xiaolei").append("<option value='"+i+"' selected>"+xls[i]+"</option>");
		}else {
			$("#xiaolei").append("<option value='"+i+"'>"+xls[i]+"</option>");
		}
	}
	
}
$(function(){
	var ue = UE.getEditor('editor',{"textarea":"content"});
	$("#myForm").ajaxForm(function (resp) {
		alert("操作成功");
		$.closeParentLayer();
	});

	newChildTag($("#dalei"));
	

});
</script>
@endsection