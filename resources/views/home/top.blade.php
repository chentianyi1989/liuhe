<div id="_lottery_menu_head" class="new-header">
    <div name="hide" style="display: block;">
        <div class="bull" id="sys_tip_outer">
        	<span class="icon-acc"></span>
        	<!-- 这里是跑马灯<marquee>标签，由js加入dom  -->
    		<marquee id="sys_tip" behavior="scroll">公告：{{$_sysConfig->note}} </marquee></div>
    		
        
        @if (Auth::guard('member')->guest())
        <div id="header_user_login" style="display: block;">
        	<form action="{{ route('user.login') }}" method="post">
            <div class="lottery_login"><div class="top-login-bg"><i class="icon-6"></i>
            	<input class="top_loginip" name="username" placeholder="请输入用户名" type="text"></div>
            <div class="top-login-bg"><i class="icon-lock-icon"></i>
            	<input class="top_loginip" name="password" placeholder="请输入密码" type="password"></div>
                <input class="lottery_anniu" name="login" value="登录" type="submit">
                <!-- 
                <input class="lottery_anniu" onclick="opRegDIV()" value="注册" type="button">
                <input class="lottery_anniu" onclick="opFreePalyDIV()" value="免费试玩" type="button">
                 -->
            </div>
            </form>
            <!-- 
            <div class="download">
                <a class="icon-appleinc" onclick="__openWin('home_phone',_static_const.download_Iphone)"></a>
                <a class="icon-android" onclick="__openWin('home_phone',_static_const.download_Android)"></a>
                <span class="down-text" onclick="__openWin('home_phone',_static_const.download_Iphone)">手机APP下载</span>
            </div>
            -->
        </div>
        @else
        <div id="header_user" class="header-user" >
            <div class="user-name">账号：<span>{{ $_user->username }}</span></div>
            <div class="user-money">余额：<span>￥{{ $_user->money }}</span></div>
            <div class="money-btn" style="float: left;">
       			<a href="/">
       				<button class="recharge" style="width: 80px">充值/提现</button></a>
       			<a href="{{ route('user.logout') }}">
       				<button class="withdraw" style="">退出</button></a>
       		</div>
           	<div class="user-center"><ul>
           		<li ><a href="{{ route('user.game_result') }}"><i class="icon-7"></i>开奖记录</a></li>
           		<li ><a href="{{ route('user.game_record') }}"><i class="icon-3"></i>下注记录</a></li>
           		<li ><a href="{{ route('user.game_record_history') }}"><i class="icon-3"></i>下注历史</a></li>
                <!--          	
                <li onclick="__openWin('other',_static_const.online_service)"><a><i class="icon-4"></i>在线客服</a></li> 
           		<li onclick="__openWin('user_center','/userCenter/privateMsg.html')"><a><i class="icon-Shape-47"></i>消息中心</a></li>
           		-->
           		</ul></div>
           		   
        </div>
        @endif
    </div>
</div>