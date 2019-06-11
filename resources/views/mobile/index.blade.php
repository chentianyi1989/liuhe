




@extends("mobile.main") 

@section('content')


    
    @include('mobile.home.ad') 
    
	@include('mobile.home.note') 
	
	
	
    <div class="box1 bg-white">
        <div class="container">
            <div class="menu flex-box">
                <a href="/case" class="flex1">
                    <i class="iconfont icon-icon-test icon1"></i>
                    <span class="text">装修案例</span>
                </a>
                <a href="/designer" class="flex1">
                    <i class="iconfont icon-shejishisheji icon2"></i>
                    <span class="text">设计大师</span>
                </a>
                <a href="/store" class="flex1">
                    <i class="iconfont icon-zhihuichangguan icon3"></i>
                    <span class="text">线下体验馆</span>
                </a>
                <a href="/case/panorama" class="flex1">
                    <i class="iconfont icon-yangbanjian icon4"></i>
                    <span class="text">VR样板间</span>
                </a>
            </div>
        </div>
    </div>
    
    
    @include('mobile.home.baojia') 
    

	<div class="box4 bg-white mt10">
        <ul class="flex-box flex-around">
            <li class="tc">
                <a href="{{route('mobile.other.baojia')}}"><i class="iconfont icon-jisuanqi"></i></a>
                <p>快速报价</p>
            </li>
            <li class="tc">
                <a href="{{route('mobile.other.yanfang')}}"><i class="iconfont icon-moniyanfang"></i></a>
                <p>免费验房</p>
            </li>
            <li class="tc">
                <a href="{{route('mobile.other.xianxiamendian')}}"><i class="iconfont icon-mendian"></i></a>
                <p>查询门店</p>
            </li>
        </ul>
<!--         <ul class="flex-box flex-around mt25"> -->
<!--             <li class="tc"> -->
<!--                 <a href="/activity"><i class="iconfont icon-huodong"></i></a> -->
<!--                 <p>优惠活动</p> -->
<!--             </li> -->
<!--             <li class="tc"> -->
<!--                 <a href="/service/finance"><i class="iconfont icon-daikuan"></i></a> -->
<!--                 <p>家装贷款</p> -->
<!--             </li> -->
<!--             <li class="tc"> -->
<!--                 <a href="/service/freecar"><i class="iconfont icon-zhuanche-copy"></i></a> -->
<!--                 <p>免费专车</p> -->
<!--             </li> -->
<!--         </ul> -->
    </div>
<!--     <a class="box5 mt10 lazy block" href="/service/homedecoration"> -->
<!--         <img data-original="//s.dyrs.cc/static/m/images/20181031_05.jpg" src="//s.dyrs.cc/static/m/images/blank.gif" class="lazy_img auto"> -->
<!--         <div class="text"> -->
<!--             <p class="title">测测<span class="text-primary">您家</span></p> -->
<!--             <p class="sub">适合的装修风格</p> -->
<!--         </div> -->
<!--     </a> -->
            
            
    @include('mobile.home.case')         
            
    @include('mobile.home.design')    
            
	@include('mobile.home.loupan')          
                
                
    {{-- @include('mobile.home.xianxiatiyan') --}}

    <div class="box10 bg-white pdt20 pdl15 pdr15 pdb20">
        <div class="mainPage-title mb10">
            <div class="left">家装服务保障体系</div>
            <a  href="/quality" class="right block" href="">了解更多 <i class="iconfont icon-icon1"></i></a>
        </div>
        <div class="tab-container mt30">
            <a class="card-item"  href="/quality">
                <div class="yuan"><i class="iconfont icon-shejituzhi"></i></div>
                <div class="title ellipsis">前沿设计</div>
                <div class="sub ellipsis">意大利设计</div>
                <div class="sub ellipsis">领衔国际团队</div>
            </a>
            <a class="card-item" href="/quality">
                <div class="yuan"><i class="iconfont icon-quanqiu1"></i></div>
                <div class="title ellipsis">寰球选材</div>
                <div class="sub ellipsis">国际权威认证</div>
                <div class="sub ellipsis">环球精选材料</div>
            </a>
            <a class="card-item" href="/quality">
                <div class="yuan"><i class="iconfont icon-mg-europe"></i></div>
                <div class="title ellipsis">欧系工艺</div>
                <div class="sub ellipsis">8+N工艺体系</div>
                <div class="sub ellipsis">比肩欧洲标准</div>
            </a>
        </div>
        <div class="tab-container mt30">
            <a class="card-item"  href="/quality">
                <div class="yuan"><i class="iconfont icon-gongcheng1"></i></div>
                <div class="title ellipsis">良心工程</div>
                <div class="sub ellipsis">工地免费开放</div>
                <div class="sub ellipsis">百闻不如一见</div>
            </a>
            <a class="card-item" href="/quality">
                <div class="yuan"><i class="iconfont icon-fangwujiaofu"></i></div>
                <div class="title ellipsis">安心交付</div>
                <div class="sub ellipsis">层层严苛验收</div>
                <div class="sub ellipsis">节点完好交付</div>
            </a>
            <a class="card-item"  href="/quality">
                <div class="yuan"><i class="iconfont icon-huanbao"></i></div>
                <div class="title ellipsis">全屋环保</div>
                <div class="sub ellipsis">东易八重防护</div>
                <div class="sub ellipsis">优于国标八倍</div>
            </a>
        </div>
    </div>



            <div class="box11 bg-white pdl15 pdr15 pdb15">
                                                <div class="img lazy">
                        <a href="/special/20190427/109424?foot">
                        <img data-original="http://img.dyrs.cc/store/092/872/000/4905cc432238abb9.jpg!l" src="//s.dyrs.cc/static/m/images/blank.gif" alt="北京东易日盛原创国际专注高端别墅装修设计,国际化的设计理念,专业的服务团队,为别墅客户提供优质室内装修设计服务。" class="lazy_img auto">
                        <div class="text">
                            <div class="title">
                                
                                
                            </div>
                            <div class="msg">
                                
                            </div>
                        </div>
                        </a>
                    </div>
                                        <form id="activityList" class="tabnav flex-box pr mt10" style="top:0;left:0" data-formvalidate="layer">
                <input type="hidden" name="kid" value="2dlksj389skj9832huifh82y2h0ioi238iutri23">
                <input type="hidden" name="desc" value="H5平台分站首页我要报名活动">
                <input type="hidden" name="action" value="visit">
                <input type="text" class="yy_phone flex1 pdl10" placeholder="您的电话号码" validate="required|phone" maxlength="11" name="phone">
                <button type="submit" class="button button-primary yy_btn tc">
                    <span>我要报名</span>
                </button>
            </form>
        </div>
    
    <div class="pdt25 pdb25 pdl15 pdr15 box12 bg-white lazy_img" data-original="//s.dyrs.cc/static/m/images/20181102_01_02.jpg">
        <ul class="soft-flow">
            <li class="bl">
                <div class="cic">
                    <i class="text-white iconfont icon-kefu3"></i>
                </div>
                <div class="text text-white mt5">1.家装咨询</div>
            </li>
            <li class="ell lazy mt20">
                <img class="lazy_img auto" data-original="//s.dyrs.cc/static/m/images/softul_29.png" src="//s.dyrs.cc/static/m/images/blank.gif" alt="">
            </li>
            <li class="bl">
                <div class="cic"><i class="iconfont icon-celiang text-white"></i></div>
                <div class="text text-white mt5">2.确认设计师</div>
            </li>
            <li class="ell lazy mt20 load-over">
                <img class="lazy_img auto" data-original="//s.dyrs.cc/static/m/images/softul_29.png" src="//s.dyrs.cc/static/m/images/blank.gif" alt="">
            </li>
            <li class="bl">
                <div class="cic"><i class="iconfont icon-yuyue text-white"></i></div>
                <div class="text text-white mt5">3.签订设计协议</div>
            </li>
            <li class="ell lazy mt20 load-over">
                <img data-original="//s.dyrs.cc/static/m/images/softul_29.png" src="//s.dyrs.cc/static/m/images/blank.gif" alt="" class="lazy_img auto">
            </li>
            <li class="bl">
                <div class="cic"><i class="iconfont icon-chanpin text-white"></i></div>
                <div class="text text-white mt5">4.设计测量</div>
            </li>
        </ul>
        <ul class="soft-flow mt20">
            <li class="bl">
                <div class="cic">
                    <i class="iconfont icon-hetong1 text-white"></i>
                </div>
                <div class="text text-white mt5">5.签订装修合同</div>
            </li>
            <li class="ell lazy mt20">
                <img data-original="//s.dyrs.cc/static/m/images/softul_29.png" src="//s.dyrs.cc/static/m/images/blank.gif" alt="" class="lazy_img auto ">
            </li>
            <li class="bl">
                <div class="cic"><i class="iconfont icon-shigongzhong text-white"></i></div>
                <div class="text text-white mt5">6.工程施工</div>
            </li>
            <li class="ell lazy mt20">
                <img data-original="//s.dyrs.cc/static/m/images/softul_29.png" src="//s.dyrs.cc/static/m/images/blank.gif" alt="" class="lazy_img auto">
            </li>
            <li class="bl">
                <div class="cic"><i class="iconfont icon-yanshou text-white"></i></div>
                <div class="text text-white mt5">7.验收安装</div>
            </li>
            <li class="ell lazy mt20">
                <img data-original="//s.dyrs.cc/static/m/images/softul_29.png" src="//s.dyrs.cc/static/m/images/blank.gif" alt="" class="lazy_img auto">
            </li>
            <li class="bl">
                <div class="cic"><i class="iconfont icon-shouhou text-white"></i></div>
                <div class="text text-white mt5">8.售后保修</div>
            </li>
        </ul>
    </div>


            
	@include('mobile.home.info')


            <div class="box15 bg-white pdl15 pdr15 pdt25">
            <div class="swiper-container" id="swiper3">
                <div class="swiper-wrapper">
                                                                        <a class="swiper-slide lazy" href="/special/20161117/101786" >
                                <img data-original="http://img.dyrs.cc/store/724/728/000/4065bd82d8b118eb.jpg!m" src="//s.dyrs.cc/static/m/images/blank.gif" alt="/store/724/728/000/4065bd82d8b118eb.jpg" title="京城名盘免费户型解析" class="lazy_img auto">
                            </a>
                                                                                                <a class="swiper-slide lazy" href="/special/20170918/103734" >
                                <img data-original="http://img.dyrs.cc/store/727/728/000/2945bd82db677193.jpg!m" src="//s.dyrs.cc/static/m/images/blank.gif" alt="/store/727/728/000/2945bd82db677193.jpg" title="大牌设计装新家" class="lazy_img auto">
                            </a>
                                                                                                <a class="swiper-slide lazy" href="/special/20170810/103473" >
                                <img data-original="http://img.dyrs.cc/store/731/728/000/7405bd82e2d8dd6d.jpg!m" src="//s.dyrs.cc/static/m/images/blank.gif" alt="/store/731/728/000/7405bd82e2d8dd6d.jpg" title="京城热装楼盘免费户型解析" class="lazy_img auto">
                            </a>
                                                            </div>
            </div>
        </div>
    
    <div class="box16 pdt20 bg-white pdr15 pdl15" style="padding-bottom: 60px;">
        <div class="connectme">
            <div class="text">
                <div class="title">联系我们</div>
                <div class="sub">24小时家装服务热线：400-9999-162</div>
            </div>
            <a class="cic" href="tel:400-9999-162"><i class="iconfont icon-dianhua"></i></a>
        </div>
    </div>

<!--客服-->
<script>
    host = document.domain;
</script>
<!--营销QQ-->
<script>
    
    $(function(){
        $('a[href*="https://static.meiqia.com/dist/standalone.html"]').each(function(i,n){
            $(this).attr('href', $.trim($(this).attr('href'))+"&metadata="+encodeURI('{"客户标识": "'+DYRSUUID+'","APPKEY": "'+code+'"}'))
        });

    })
    
</script>


@endsection

@section('mate.js')

@endsection