<div class="box6 mt10 bg-white">
	<div class="mainPage-title">
		<div class="left">家装案例品鉴111</div>
		<a class="right block" href="/case">查看全部 <i
			class="iconfont icon-icon1"></i></a>
	</div>
	<div class="case-box clearfix">
		<div class="swiper-container mt10" id="swiper2">
			<div class="swiper-wrapper" id="swiper2_main">

				<div class="swiper-slide flex-box middle-j">
					<div class="anli lazy load-over fl" style="width: 6.8rem">
						<a href="/case/129090" rel="nofollow"> 
							<img class="lazy_img auto bgimg"
							src="http://artwork.dyrs.cc/photo/016/078/000/44257b2da3c3953e.jpg!hm" alt="">
							<div class="bgimg"></div>
						</a> 
						<a class="designer" href="/designer/101355" rel="nofollow">
							<div class="photo lazy load-over">
								<img class="lazy_img auto"
									data-original="http://img.dyrs.cc/store/827/739/000/7135bea4e4c3ecb3.jpg!zs"
									src="http://img.dyrs.cc/store/827/739/000/7135bea4e4c3ecb3.jpg!zs" alt="李亚楠">
							</div>
							<div class="name">李亚楠</div>
						</a>
						<div class="text">
							<div class="title ellipsis"></div>
							<div class="sub ellipsis">
								<a href="/case/ht1">别墅</a> <a href="/case/s7">新中式</a> <a
									href="/case/ha4">321-500平米</a>
							</div>
						</div>
						<div class="collect">
							<div>
								<i class="iconfont icon-tupian"></i> 6
							</div>
						</div>
					</div>
				</div>

				<!-- 
    				<div class="swiper-slide flex-box middle-j">
    					<div class="anli lazy load-over fl" style="width: 6.8rem">
    						<a href="/case/110699" rel="nofollow"> <img
    							class="lazy_img auto bgimg"
    							data-original="http://artwork.dyrs.cc/photo/016/078/000/44257b2da3c3953e.jpg!hm"
    							src="//s.dyrs.cc/static/pc/images/blank.gif" alt="">
    							<div class="bgimg"></div>
    						</a>
    						<div class="text">
    							<div class="title ellipsis"></div>
    							<div class="sub ellipsis">
    								<a href="/case/ht1">别墅</a> <a href="/case/s5">美式乡村</a> <a
    									href="/case/ha3">181-320平米</a>
    							</div>
    						</div>
    						<div class="collect">
    							<div>
    								<i class="iconfont icon-tupian"></i> 6
    							</div>
    							<div>
    								<i collect-status="no" class="iconfont icon-xin"
    									collect-id="110699"
    									onclick="page.setCollect('110699','case',this)"></i> 34
    							</div>
    						</div>
    					</div>
    				</div> -->
			</div>
			<div></div>
		</div>
		<div class="tab">
			<a href="/case/s2">现代简约</a> 
			<a href="/case/s1">欧式古典</a> 
			<a href="/case/s7">新中式</a> 
			<a href="/case/s34">法式</a> 
			<a href="/case">更多</a>
		</div>
	</div>
</div>

<html>
<script type="text/javascript">
$(function (){


	$.ajax({
		type:"GET",
        url:"{{ route('mobile.api.case.list') }}",
        dataType:"json",
        success:function(req){
            var datas = req.datas;
            console.log("req.datas",datas);
            var caseList = datas.data;

			for(var i in caseList) {

				$("#swiper2_main").append($.caseShow(caseList[i]));
			}

			var mySwiper = new Swiper('#swiper2', {
		        // autoplay: true,//可选选项，自动滑动
		        freeMode : true,
		         on:{
		            touchMove: function(event){
		                //你的事件
		                $(window).scroll()
		            },
		        },
		        slideChangeTransitionEnd : function (){
		            $(window).scroll()
		        }
		    })
        },
        error:function(jqXHR){
            console.log("Error: "+jqXHR.status);
        }
    });
	
    $.extend({

		"route":function (url,params) {
			for (var i in params) {
				url = url.replace("\!"+i,params[i]);
			}
			return url;
		},
        
		"caseShow":function(data) {

			
			function main (data) {

				var imgUrl = ""
					
				if (data['keting']) {
					
					var json = JSON.parse(data['keting']);
					imgUrl = json["url"];
				}
				var url = $.route('{{route("mobile.case.index","!0")}}',[data["id"]]) ;
				var main = $('<div class="anli lazy load-over fl" style="width: 6.8rem">');
				var a = $('<a href="'+url+'" rel="nofollow">');
				a.append($('<img class="lazy_img auto bgimg" src="'+imgUrl+'">'))
    				.append('<div class="bgimg"></div>')
    			return main.append(a);
			}

			function footer (data) {
    				var div = $('<div class="sub ellipsis">');
    				div.append($('<a href="/case?fengge='+data.fengge+'">'+data.fengge_name+'</a>'))
    					.append($('<a href="/case?leixing='+data.leixing+'">'+data.leixing_name+'</a>'))
    					.append($('<a>').html(data.mianji));
    			return $('<div class="text">')
    					.append('<div class="title ellipsis"></div>').append(div);
			}
			
			var slide = $('<div class="swiper-slide flex-box middle-j">');
			
			slide.append(main(data).append(footer(data)));

			return slide;

// 			function shejishi () {
				
// 				<a class="designer" href="/designer/101355" rel="nofollow">
//     				<div class="photo lazy load-over">
//     					<img class="lazy_img auto"
//     						data-original="http://img.dyrs.cc/store/827/739/000/7135bea4e4c3ecb3.jpg!zs"
//     						src="//s.dyrs.cc/static/pc/images/blank.gif" alt="李亚楠">
//     				</div>
//     				<div class="name">李亚楠</div>
//     			</a>
// 			}

			

// 			function tuNum () {
// 				<div class="collect">
//     				<div>
//     					<i class="iconfont icon-tupian"></i> 6
//     				</div>
//     			</div>
// 			}
		}

    });

    
})
</script>



</html>