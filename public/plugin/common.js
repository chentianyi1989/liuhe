$(function () {
	$.fn.extend({
		"baojia":function (success){
			form = $(this);
			$.ajax({
				//{{route('mobile.api.baojia.save')}}
				 url : "/api/baojia/save",
				 data : form.serialize(),
				 type:'post',
				 success : function(res){
					 if (success) {
						 success(res);
					 } else {
						 alert("提交成功");
					}
				 }
			})
		},
//		"ajaxSubmit":function(success){
//			
//			var btn = $(this);
//			btn.click(function(){
//				
//				btn.attr('disabled', true);
//
//		        var go = true;
//		        var form = $(this).parents('form');
//		        var url = form.attr('action');
//		        var method = form.attr('method');
//		        
////		        var rest_method = form.find("input[name='_method']");
////		        var method_s = rest_method.length > 0 ? rest_method.val() : method;
//		        if (go == true) {
//		            var detailLoad = layer.load(2, {
//		                shade: [0.2, '#ccc'], //遮罩层背景色、透明度,
//		                //shade:false
//		            });
//		            $.ajax({
//		                type: method,
//		                url: url,
//		                data: new FormData(form),
//		                dataType: "json",
//		                contentType : false,//当form以multipart/form-data方式上传文件时，需要设置为false
//		                processData : false,//如果要发送Dom树信息或其他不需要转换的信息，请设置为false
//		                success: function(data){
//		                    layer.close(detailLoad);
////		                    btn.attr('disabled', false);
////		                	alert("2");
//		                    if(success) {
//		                    	success(data);
//		                    }
//		                }
//		                
//		            });
//		        }
//			})
//		}	
	})
	
	$.extend({
		
		"closeParentLayer":function () {
			window.parent.location.reload();
			var index = parent.layer.getFrameIndex(window.name);
			parent.layer.close(index);
		}
		
	})
})