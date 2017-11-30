<div class="gm_con_to" style="max-width:1040px;margin-left:auto;margin-right:auto;">
    <div style="margin-top:5px;" class="unit_title">
        <div class="ut_l"></div>
        <div class="ut_r"></div>
    </div>
    <div class="gct_l">
        <a href="{{ route('index') }}"><div class="game-icon1 game_sixlottery"></div></a>
        <p class="time-title">已开盘,欢迎投注。距离关盘还有</p>
        <div class="gct-time">
            <div class="gct-time-now">
                <input id="lottory_open" value="true" type="hidden">
                <div class="gct-time-now-l" id="count_down"> <span class="leaveh-1">4</span><span class="leaveh-2">0</span><span class="interval">:</span><span class="leavem-1">2</span><span class="leavem-2">2</span><span class="interval">:</span><span class="leaves-1">5</span><span class="leaves-2">0</span>
                </div>
            </div>
        </div>
        <h3 name="page_name">{{$_sysConfig->title}}</h3>
        <div class="gct_now"><strong>第&nbsp;&nbsp;<span id="current_issue" class="color-green">{{$currGameResult->code}}</span>&nbsp;&nbsp;期</strong>
            <br>
            <a href="{{ route('user.mb') }}" target="_blank" class="bt01">
            	<span class="zoushi"></span>马报</a></div>
        <div class="clear"></div>
        <div class="gct_menu">
            <a class="gct_menu_yl" target="_blank"></a>
        </div>
    </div>
    <div id="showgd-box">
       <ul class="box-ul">
			<li><a class="tabulous_active" index="2">近五期开奖</a></li>
			<span class="tabulousclear"></span>
		</ul>
        <div id="tabs_container" style="height:120px;">
            <div id="gd-box2" class="hideleft" style="position: absolute; top: 40px;">
            	
            	@foreach($gameResult as $gr)
                	<p>第 <span class="col-r">{{ $gr->code }}</span> 期:&nbsp;&nbsp;  
                		@foreach($gr->pingma_result as $r)
                        	<span class="col-{{ $r }}">{{$r}}</span> 
                        @endforeach
                        + <span class="col-{{$gr->tema_result}}">{{$gr->tema_result}}</span>
                    </p>
                
                @endforeach
            </div>
        </div>
        <!--End tabs container-->
    </div>
    <div class="clear"></div>
</div>