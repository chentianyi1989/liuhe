@extends("mobile.main")


@section('content')
<div class="container service-s" id="wrapper">
    <div class="topimg">
        <img src="/m/baojia/image/service02.jpg" alt="">
        <div class="text fb" style="top:.5rem">提前算一算</div>
        <div class="text fb" style="top:1.2rem">装修要花多少钱?</div>
    </div>
    <div class="bottomimg">
        <img src="/m/baojia/image/service05.jpg" alt="客户服务免费快速报价免费报价">
        <form id="price" method="post" action="{{route('mobile.api.baojia.save')}}">
            <input value="H5客户服务免费快速报价免费报价" name="source" type="hidden">
            <input validate="required" style="top:.4rem" placeholder="您的称呼" autocomplete="off" name="name" type="text">
            <input validate="required|phone" style="top:1.34rem" placeholder="您接收报价的号码" maxlength="11" name="phone" autocomplete="off" type="text">
            <input style="top:2.2rem" placeholder="您的房屋面积" name="mianji" autocomplete="off" type="text">
            <input style="top:3.1rem" placeholder="您的楼盘/小区名称" name="loupan" autocomplete="off" type="text">
            <input type="submit" class="button button-primary" value="立即计算" >
        </form>
    </div>
    <div class="phone tc"><i class="iconfont icon-dianhua"></i> 400-6600-598</div>
    <div class="black-title">提前报价 省心省力</div>
    <div class="saveHeart">
        <div class="card">
            <div class="img lazy load-over"><img class="lazy_img auto load-over" data-original="" src="//s.dyrs.cc/static/m/images/20181023-01.jpg" alt="" style="display: block; width: 100%; height: auto; top: 0%; left: 0px;"></div>
            <div class="text">
                <p>轻松三步</p>
                <p>即获报价清单</p>
            </div>
        </div>
        <div class="card">
            <div class="img lazy load-over"><img class="lazy_img auto load-over" data-original="" src="//s.dyrs.cc/static/m/images/20181023-02.jpg" alt="" style="display: block; width: auto; height: 100%; left: -0.882353%; top: 0px;"></div>
            <div class="text">
                <p>上市公司实力</p>
                <p>让你省心更安心</p>
            </div>
        </div>
        <div class="card">
            <div class="img lazy load-over"><img class="lazy_img auto load-over" data-original="" src="//s.dyrs.cc/static/m/images/20181023-03.jpg" alt="" style="display: block; width: auto; height: 100%; left: -1.17647%; top: 0px;"></div>
            <div class="text">
                <p>透明电子报价</p>
                <p>无需担忧增减项</p>
            </div>
        </div>
    </div>
    <div class="black-title">做到心中有数！仅需3步！</div>
    <div class="serve-have-num">
        <div class="card">
            <div class="img lazy_img load-over" data-original="//s.dyrs.cc/static/m/images/20181023-04.jpg" style="display: block; background-image: url(&quot;//s.dyrs.cc/static/m/images/20181023-04.jpg&quot;);">
                <i class="iconfont icon-yuyue"></i>
            </div>
            <div class="num">1</div>
            <div class="text">在线免费预约</div>
        </div>
        <div class="card">
            <div class="img lazy_img load-over" data-original="//s.dyrs.cc/static/m/images/20181023-04.jpg" style="display: block; background-image: url(&quot;//s.dyrs.cc/static/m/images/20181023-04.jpg&quot;);">
                <i class="iconfont icon-kefu"></i>
            </div>
            <div class="num">2</div>
            <div class="text">客服致电沟通</div>
        </div>
        <div class="card" style="padding-bottom:1.2rem">
            <div class="img lazy_img load-over" data-original="//s.dyrs.cc/static/m/images/20181023-04.jpg" style="display: block; background-image: url(&quot;//s.dyrs.cc/static/m/images/20181023-04.jpg&quot;);">
                <i class="iconfont icon-baojia"></i>
            </div>
            <div class="num">3</div>
            <div class="text">获取智能报价</div>
        </div>
    </div>
</div>
@endsection

@section("jscss")

<script>

$(function () {

	$("#price").ajaxForm(function (resp) {
		alert("报价成功");
	});
})
</script>

@endsection