<?php 


?>
@extends('admin.form')
@section('content')
<article class="page-container">
	<form action="{{ route('learn.save')}}" method="post" class="form form-horizontal" id="myForm" enctype="multipart/form-data">
		<input name="id" value="{{ @$bean->id}}" readonly="readonly">
		
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>资源名称：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<input type="text" class="input-text" value="{{ @$bean->name}}" placeholder="" name="name">
    		</div>
    	</div>
    	
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文件：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="url" class="input-file" value="{{ @$bean->url }}">
				</span>
    		</div>
    	</div>
    	
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>备注：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<input type="text" class="input-text" value="{{ @$bean->info}}"" placeholder="100-200平" name="info">
    		</div>
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
<!-- <script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script>  -->
<!-- <script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script>  -->
<!-- <script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script>  -->
<script type="text/javascript" src="{{asset('/plugin/webuploader/0.1.5/webuploader.js')}}"></script> 

<script type="text/javascript">

$(function(){

	$("#myForm").ajaxForm(function (resp) {
		alert("操作成功");
		$.closeParentLayer();
	});

});
</script>
@endsection