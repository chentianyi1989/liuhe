@extends('admin.form')

@section('content')
<article class="page-container">
	<form action="{{ route('learn.save')}}" method="post" class="form form-horizontal" id="myForm" enctype="multipart/form-data">
		<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>项目名称：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<input type="text" class="input-text" value="{{ @$bean->name}}" placeholder="" name="name">
    		</div>
    	</div>
	
		<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>面积：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<input type="text" class="input-text" value="{{ @$bean->mianji}}" placeholder="" name="mianji">
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

<script type="text/javascript">

$(function(){

	$("#myForm").ajaxForm(function (resp) {
		alert("操作成功");
		$.closeParentLayer();
	});

});
</script>
@endsection