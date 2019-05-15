<?php 


?>
@extends('admin.form')
@section('content')

	<form action="{{ route('case.save')}}" method="post" class="form form-horizontal" id="form-member-add" enctype="multipart/form-data">
		<input name="id" value="{{ @$case->id}}" readonly="readonly">
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>标题：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<input type="text" class="input-text" value="{{ $case->title or ''}}" placeholder="" name="title">
    		</div>
    	</div>
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>面积：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<input type="text" class="input-text" value="{{ $case->title or ''}}"" placeholder="100-200平" name="mianji">
    		</div>
    	</div>
    	
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>风格：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<select class="input-text" name="fengge">
    				@foreach(config('sys.fengge') as $k => $v)
    					@if($case && $case->fengge==$k)
    						<option value="{{ $k }}" selected>{{ $v }}</option>
    					@else
                        	<option value="{{ $k }}" >{{ $v }}</option>
                        @endif
                    @endforeach
    			</select>
    		</div>
    	</div>
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类型：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<select class="input-text" name="leixing">
    				@foreach(config('sys.leixing') as $k => $v)
						@if(@$case->leixing==$k)
							<option value="{{ $k }}" selected>{{ $v }}</option>
						@else
                        	<option value="{{ $k }}" >{{ $v }}</option>
                        @endif
                    @endforeach
                </select>
    		</div>
    	</div>
    	
    	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">户型图：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="huxingtu" class="input-file">
				</span>
				<input class="input-text" placeholder="图片的描述" name="huxingtu_name"/>
    		</div>
    	</div>
    	
    	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">客厅：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="keting" class="input-file">
				</span>
				<input class="input-text" placeholder="图片的描述" name="keting_name"/>
    		</div>
    	</div>
    	
    	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">卧室：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="woshi" class="input-file">
				</span>
				<input class="input-text" placeholder="图片的描述" name="woshi_name"/>
    		</div>
    	</div>
    	
    	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">书房：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="shufang" class="input-file">
				</span>
				<input class="input-text" placeholder="图片的描述" name="shufang_name"/>
    		</div>
    	</div>
    	
    	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">餐厅：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="canting" class="input-file">
				</span>
				<input class="input-text" placeholder="图片的描述" name="canting_name"/>
    		</div>
    	</div>
    	
    	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">玄关：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="xunguan" class="input-file">
				</span>
				<input class="input-text" placeholder="图片的描述" name="xunguan_name"/>
    		</div>
    	</div>
    	
    	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">卫生间：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="weishengjian" class="input-file">
				</span>
				<input class="input-text" placeholder="图片的描述" name="weishengjian_name"/>
    		</div>
    	</div>
    	
    	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">其他：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
    				<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
    				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
    				<input type="file" multiple name="qita" class="input-file">
				</span>
				<input class="input-text" placeholder="图片的描述" name="qita_name"/>
    		</div>
    	</div>
    	
    	<div class="row cl">
    		<label class="form-label col-xs-4 col-sm-3">设计理念：</label>
    		<div class="formControls col-xs-8 col-sm-9">
    			<textarea name="shejilinian" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)">{{@$case->shejilinian}}</textarea>
    			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
    		</div>
    	</div>
    	<div class="row cl">
    		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
    			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
    		</div>
    	</div>
    </form>

	

@endsection

@section('mate.js')
<link href="{{asset('/plugin/webuploader/0.1.5/webuploader.css')}}" rel="stylesheet" type="text/css" />
<!-- <script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script>  -->
<!-- <script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script>  -->
<!-- <script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script>  -->
<script type="text/javascript" src="{{asset('/plugin/webuploader/0.1.5/webuploader.js')}}"></script> 

<script type="text/javascript">
function article_save(){
	alert("刷新父级的时候会自动关闭弹层。")
	window.parent.location.reload();
}

function addtemplate () {
	
	
// 	$("<tr>")

// 	<tr>
//     	<td><input class="input-text" placeholder="位置（客厅、餐厅）"/></td>
//     	<td><input class="input-text" placeholder="图片的描述"/></td>
//     	<td>
//     		<span class="btn-upload form-group">
//     			<input class="input-text upload-url" type="text" name="" id="" readonly nullmsg="请添加附件！" style="width:200px">
//     			<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
//     			<input type="file" multiple name="file-2" class="input-file">
//     		</span>
//     	</td>
//     	<td>
//     		<a title="删除" href="javascript:;" onclick="" class="ml-5" style="text-decoration:none">
//     			<i class="Hui-iconfont">&#xe6e2;</i></a>
//     	</td>
//     </tr>

}

$(function(){
	
});
</script>
@endsection