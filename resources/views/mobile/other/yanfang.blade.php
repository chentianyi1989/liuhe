@extends("mobile.main")


@section('content')
<div class="container service-s" id="wrapper">
    <div class="topimg">
        <img src="/m/yanfang/image/service01.jpg" alt="先验房在装修">
        <div class="text fb" style="top:.5rem">先验房再装修</div>
        <div class="testHouse">
            <ul class="middle-j" style="margin-left:-.35rem">
                <li class="cic" style="margin-right:.2rem">
                    <i class="iconfont icon-shenqing"></i>
                </li>
                <li class="cfx lazy_img load-over" data-original="//s.dyrs.cc/static/m/images/service17.png" style="display: list-item; background-image: url(&quot;//s.dyrs.cc/static/m/images/service17.png&quot;);"></li>
                <li class="cic" style="margin-left:.4rem;margin-right:.4rem">
                    <i class="iconfont icon-kefu2"></i>
                </li>
                <li class="cfx lazy_img load-over" data-original="//s.dyrs.cc/static/m/images/service17.png" style="display: list-item; background-image: url(&quot;//s.dyrs.cc/static/m/images/service17.png&quot;);"></li>
                <li class="cic" style="margin-left:.2rem">
                    <i class="iconfont icon-mianfeiyanfang-jinhuang"></i>
                </li>
            </ul>
            <ul class="flex-between" style="margin-top:.1rem">
                <li>1.申请免费验房</li>
                <li>2.客服沟通</li>
                <li>3.专家免费上门验房</li>
            </ul>
        </div>
    </div>
    <div class="bottomimg">
        <img src="/m/yanfang/image/service07.jpg" alt="免费上门验房服务">
        <form method="post" id="yuyue" data-formvalidate="layer">
            <input value="H5客户服务免费上门验房免费预约" name="source" type="hidden">
            <div class="form-title">免费上门验房服务</div>
            <input validate="required" style="top:1.34rem" placeholder="您的称呼" name="name" autocomplete="off" type="text">
            <input validate="required|phone" style="top:2.2rem" placeholder="您的手机号码" maxlength="11" name="phone" autocomplete="off">
            <input style="top:3.1rem" placeholder="您的楼盘/小区名称" autocomplete="off" name="loupan" type="text">
            <input class="button button-primary" type="button" value="免费预约" onclick="baojia()">
        </form>
    </div>
    <div class="phone tc"><i class="iconfont icon-dianhua"></i> 400-6600-598</div>
    <div class="black-title">在装修前为新房进行一次全面体检</div>
    <div class="testHouse-flow" style="margin-top:.4rem">
        <div class="t-f">
            <div class="cic">
                <i class="iconfont icon-shoufangyanfang"></i>
            </div>
            <p>省心收房</p>
        </div>
        <div class="t-f">
            <div class="cic">
                <i class="iconfont icon-baozhang"></i>
            </div>
            <p>权益保障</p>
        </div>
        <div class="t-f">
            <div class="cic">
                <i class="iconfont icon-zhuangxiu1"></i>
            </div>
            <p>安心装修</p>
        </div>
    </div>
    <div class="testHouse-flow" style="margin-top:.4rem">
        <div class="t-f">
            <div class="cic">
                <i class="iconfont icon-B-shigongbaozhang"></i>
            </div>
            <p>施工保障</p>
        </div>
        <div class="t-f">
            <div class="cic">
                <i class="iconfont icon-stay"></i>
            </div>
            <p>放心入住</p>
        </div>
        <div class="t-f">
            <div class="cic">
                <i class="iconfont icon-zhifu"></i>
            </div>
            <p>交付保障</p>
        </div>
    </div>
    <div class="black-title">房屋8项检查清单</div>
    <div class="checkHouse" style="margin-top:.6rem">
        <div class="check-item">
            <div class="num">01</div>
            <div>
                <p>墙面空鼓</p>
                <p>脱皮</p>
            </div>
        </div>
        <div class="check-item">
            <div class="num">02</div>
            <div>
                <p>接口有</p>
                <p>漏水</p>
            </div>
        </div>
        <div class="check-item">
            <div class="num">03</div>
            <div>
                <p>地面不</p>
                <p>平整</p>
            </div>
        </div>
        <div class="check-item">
            <div class="num">04</div>
            <div>
                <p>走线不</p>
                <p>规范</p>
            </div>
        </div>
    </div>
    <div class="checkHouse" style="margin-top:.4rem">
        <div class="check-item">
            <div class="num">05</div>
            <div>
                <p>室内门窗</p>
                <p>有磕碰痕迹</p>
            </div>
        </div>
        <div class="check-item">
            <div class="num">06</div>
            <div>
                <p>给水不通</p>
                <p>流污水</p>
            </div>
        </div>
        <div class="check-item">
            <div class="num">07</div>
            <div>
                <p>预留口</p>
                <p>不合理</p>
            </div>
        </div>
        <div class="check-item">
            <div class="num">08</div>
            <div>
                <p>门窗轨道</p>
                <p>不通畅</p>
            </div>
        </div>
    </div>
    <div class="black-title">房屋体检项目</div>
    <div class="houseProduct">
        <div class="proItem">
            <div class="img">
                <img class="lazy_img auto load-over" src="/m/yanfang/image/service18.jpg" alt="" style="display: block; width: 100%; height: auto; left: 0px;">
            </div>
            <div class="text">防盗门</div>
        </div>
        <div class="proItem">
            <div class="img">
                <img class="lazy_img auto load-over" src="/m/yanfang/image/service19.jpg" alt="" style="display: block; width: 100%; height: auto; left: 0px;">
            </div>
            <div class="text">地面</div>
        </div>
        <div class="proItem">
            <div class="img">
                <img class="lazy_img auto load-over" src="/m/yanfang/image/service20.jpg" alt="" style="display: block; width: 100%; height: auto; left: 0px;">
            </div>
            <div class="text">墙面</div>
        </div>
        <div class="proItem">
            <div class="img">
                <img class="lazy_img auto load-over" src="/m/yanfang/image/service21.jpg" alt="" style="display: block; width: 100%; height: auto; left: 0px;">
            </div>
            <div class="text">室内门窗</div>
        </div>
    </div>
    <div class="houseProduct" style="margin-top:.2rem;padding-bottom:.7rem">
        <div class="proItem">
            <div class="img">
                <img class="lazy_img auto load-over" src="/m/yanfang/image/service22.jpg" alt="" style="display: block; width: 100%; height: auto; left: 0px;">
            </div>
            <div class="text">阳台</div>
        </div>
        <div class="proItem">
            <div class="img">
                <img class="lazy_img auto load-over" data-original="//s.dyrs.cc/static/m/images/service23.jpg" src="/m/yanfang/image/service23.jpg" alt="" style="display: block; width: 100%; height: auto; left: 0px;">
            </div>
            <div class="text">给水</div>
        </div>
        <div class="proItem">
            <div class="img">
                <img class="lazy_img auto load-over" data-original="//s.dyrs.cc/static/m/images/service24.jpg" src="/m/yanfang/image/service24.jpg" alt="" style="display: block; width: 100%; height: auto; left: 0px;">
            </div>
            <div class="text">排水</div>
        </div>
        <div class="proItem">
            <div class="img">
                <img class="lazy_img auto load-over" data-original="//s.dyrs.cc/static/m/images/service25.jpg" src="/m/yanfang/image/service25.jpg" alt="" style="display: block; width: 100%; height: auto; left: 0px;">
            </div>
            <div class="text">电气</div>
        </div>
    </div>
</div>
@endsection

@section("jscss")



<script>
function baojia() {

	$("#yuyue").baojia(function (res) {
		alert("提交成功");
	});
}
</script>

@endsection