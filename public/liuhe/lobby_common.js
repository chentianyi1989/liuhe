///*2019-08-20 */
///* 该文件包括 购彩大厅动能 ：1 彩票左边menu列表； 2 头部html; 3 定义了全局的刷新余额的方法： window.refreshAmount */
/*
 * 1. 定时刷新余额功能（60秒一次）
 * 2. 定时刷新彩票 （1秒一次）
 * 3. 彩票的顺序要排序 （按照后台接口的顺序排序，排序后的顺序在 lottery.arr 里 ）
 * 4. 左边menu中菜单的张开收起，对应的右边彩票需要同步切换（只针对 购彩大厅主页）
 * 5. 检查登录 （头部样式）
 * 6. 修改头部的名称（针对购彩大厅主页 之外的页面）
 * */

/**
 * 下面是静态常量
 * _static_const是命名空间
 */
window._static_const = {
    //在线客服url
    online_service:(typeof(_layout)=="object")?_layout.kf_url:"",
    download_Iphone: "/index/mobile.html",
    //安卓下载链接
    download_Android :"/index/mobile.html",
    //注册
    register_url :"/register/index.html",
    //购彩大厅
    home_lottery:"/index/lobby.html",
    //退出接口
    Signout_url : "/index/LogOut.html"
};

// 全局变量： 所有彩种
window.lottery = {
    arr : [], //彩种 [ [sort,id], [sort,id], [sort,id], [sort,id] ] （升序排序） （周期：后面被delete掉，lottery.arr 将变成 undefined ）
    gameIds:"", //（周期：永久）
    obj:{}  //key:id;  value:{ lottery }
};

//_lottery_menu 是该文件的命名空间
window._lottery_menu = {
    ////检测是否登录
    checkLogin : function(flag){
        var res = true;
        $.ajax({'url': '/index/ajaxGetLoginMsg.html',
            'dataType': 'json',
            'type': 'post',
            async:false,
            'success': function (data) {
                if (data.loginId != '' && data.loginId != undefined && data.loginId != null)
                {  //已登陆
                    $("#header_user").css("display","block");
                    $("#header_user_login").css("display","none");
                    $('#user_name').html(data.loginId);
                    $('#balance').html( data.balance?("￥"+data.balance):"￥0" );
                    _user_.isLogin="true";
                    _user_.userName = data.loginId;
                    if(flag=="reload")
                    {
                        window.location.reload();
                    }
                }
                else
                {
                    res=false;
                    try{
                        //解决 密码 被浏览器自动填充的问题
                        (function(){
                            var parentSelector = "#header_user_login";
                            var _flag_click_input_1 = false;
                            $(parentSelector+" input[type=text],"+parentSelector+" input[type=password]").bind("click", function () {
                                //如果鼠标人为进行一次点击过,则进入下面逻辑
                                _flag_click_input_1 = true;
                            });
                            $(parentSelector+' [name=passwd]').bind("input", function () {
                                if (!_flag_click_input_1) {//如果鼠标没有进行一次点击过,则进入下面逻辑
                                    $(this).val("");
                                }
                            });
                            $(parentSelector+' [name=passwd]').val("");
                        })();
                    }catch(e){console.log(e);}
                    $("#header_user").css("display","none");
                    $("#header_user_login").css("display","block");
                    var selector_1 = "#header_user_login", selector_2 = "#header_user";
                    $(selector_1+" [name=login]").bind("click",function(){
                        var rst = _user_.doLogin(selector_1,selector_2,false);
                        if( rst!==false &&  $("#i_list_2 iframe").length > 0 )
                        {
                            if(_lottery_menu.checkLogin("reload")==false)
                            {
                                setTimeout(function()
                                {
                                    window.location.reload();
                                },700);
                            }
                        }
                    });
                    var parentSelector = '#header_user_login';
                    $(parentSelector+" [name=\"login_img\"],"+parentSelector+" [name=\"btn_refresh\"],"+parentSelector+" [name=\"div_top_click\"]").click(function newVerify()
                    {
                        $("img[name=\"login_img\"]").attr('src', '/seccode/makecode.html?nchash=&t=' + Math.random());
                        $(parentSelector+" [name=\"authnum\"]").val('').trigger("focus");
                        $(parentSelector+" [name=\"div_top_click\"]").hide();
                    });
                    $(parentSelector).get(0).onkeydown = function (event){
                        var e = event || window.event || arguments.callee.caller.arguments[0];
                        if( e.keyCode == 9 )
                        {
                            try{if(e.preventDefault){e.preventDefault();}else{e.returnValue = false;}}catch(e){}
                        }
                        if (e && (e.keyCode == 13 || e.keyCode == 9 ) ) { // enter 键
                            if ($.trim($(parentSelector+" [name=username]").val()) == '') {
                                $(parentSelector+" [name=username]").focus();
                                return;
                            }
                            if ($.trim($(parentSelector+" [name=passwd]").val()) == '') {
                                $(parentSelector+" [name=passwd]").focus();
                                return;
                            }  
                            if ($.trim($(parentSelector+" [name=authnum]").val()) == '') {
                                $(parentSelector+" [name=authnum]").focus();
                                return;
                            }
                            var rst =  _user_.doLogin(selector_1,selector_2,false);
                            if( rst!==false &&  $("#i_list_2 iframe").length > 0 )
                            {
                                if(_lottery_menu.checkLogin("reload")==false)
                                {
                                    setTimeout(function()
                                    {
                                        window.location.reload();
                                    },700);
                                }
                            }
                        }
                    };

                    function changeImg(nofocus)
                    {
                        $(selector_1+ ' [name=login_img]').attr('src', '/seccode/makecode.html?nchash=&t=' + Math.random());
                        if( !nofocus )
                        {
                            $(selector_1+' input[name=authnum]').val('').focus();
                        }
                        $(selector_1+" [name=\"div_top_click\"]").hide();
                    }
                    $(selector_1+" [name=authnum]").bind("focus",function()
                    {
                        if($(this).val()=="")
                        {
                            changeImg(true);
                        }
                        try{if(event.preventDefault){event.preventDefault();}else{event.returnValue = false;}}catch(e){}
                    });
                    $(selector_1+" [name=login_img]").bind("click",function(){
                        changeImg();
                        try{if(event.preventDefault){event.preventDefault();}else{event.returnValue = false;}}catch(e){}
                    });
                }
            }
        });
        return res;
    },
    //彩票页面的 头部
    head : function(){
        (function (){
            //头部张开或收起的按钮
            $("#_lottery_menu_head>button").click(function(){
                if( $("#_lottery_menu_head>div[name]").css("display") != "none" )
                {
                    $("#_lottery_menu_head>div[name]").hide();
                    $("#_lottery_menu_head>button").addClass("_open").removeClass("_close");
                    $('#iframeDivList').css("height",($(window).height())+"px");
                }
                else
                {
                    $("#_lottery_menu_head>div[name]").show();
                    $("#_lottery_menu_head>button").addClass("_close").removeClass("_open");
                    $('#iframeDivList').css("height",($(window).height()-$("#_lottery_menu_head").height())+"px");
                }
            });
        })();
        //检查是否登录
        _lottery_menu.checkLogin();
        ///*跑马灯 - 系统公告*/
        (function sys_tip( domSelector ){
            $.ajax({
	            'url': '/index/getMqData.html',
	            'dataType': 'json',
	            'type': 'post',
	            'success': function (data) {
	            	$("#sys_tip_outer").append("<marquee id=\"sys_tip\" behavior=\"scroll\"></marquee>");
	            	///* marquee标签必须由后来添加，和innerHTML同时存在，不可先于内容存在  */
	        		var html = data.html?data.html.replace(/<br\s*\/?>/gi, "&nbsp;&nbsp;"):"";
	        		var marqueeDom = $("#sys_tip")
	            	marqueeDom.html(html);
	            }
	        });
        })("#sys_tip_outer");
    },
    //彩票页面的 左边menu
    leftMenu : function (){
        $.ajax({
            'url': '/index/ajaxGetAllGameStatus.html',
            'dataType': 'json',
            'type': 'post',
            'success': function (data) {
                try
                {
                    if ( session_timeout(data) === false )
                    {
                        // return false;
                    }
                } catch(e){ console.log(e);}
                var count = data.count;
                if (count === 0) {
                    $("#live-main-list").html("");
                    return;
                }
                var static_value = {
                    topNum : 6 ,  //热门彩种，选前5个作为热门彩种
                    type:{  // 彩种类别
                        1:"时时彩",
                        2:"快三",
                        3:"十一选5",
                        5:"其他"
                    }
                };
                //热门彩种
                var hotHtmlArr = [];
                //高频彩种
                var highHtmlArr = [];
                var arr1 = [], arr2 = [], arr3 = [], arr4 = [];  // 1 时时彩, 2 快三 , 3 十一选五,pc蛋蛋
                //低频
                var lowHtmllArr = [];
                var gameIdStr_hot = "",//热门彩票的id拼接 如: id1,id2,id3,id4,
                    gameIdStr1 = "" ,  //时时彩 的id拼接 如: id1,id2,id3,id4,
                    gameIdStr2 = "" ,   //快三 的id拼接 如: id1,id2,id3,id4,
                    gameIdStr3 = "",  // 11 选 5 的id拼接 如: id1,id2,id3,id4,
                    gameIdStr4 = "",  // PC蛋蛋 的id拼接 如: id1,id2,id3,id4,
                    gameIdStr_high = "",  // 高频彩票 的id拼接 如: id1,id2,id3,id4,
                    gameIdStr_low = "";  // 低频彩票 的id拼接 如: id1,id2,id3,id4,
                //新加快乐十分
                var happy_list=[];//
                var happy_Str="";//id拼接 如: id1,id2,id3,id4,
                for (var i = 0; i < count; i++)
                {
                    var sort = data.games[i].sort;
                    var id = data.games[i].id;
                    lottery.gameIds += id + ",";;
                    lottery.obj[id] = data.games[i];
                    if( lottery.arr.length >0 )
                    {
                        if( sort - lottery.arr[ lottery.arr.length-1 ][0] >= 0  )
                        {
                            lottery.arr.push( [sort,id] );
                        }
                        else
                        {
                            var ll = lottery.arr.length;
                            for( var j=0 ; j < ll; j++ )
                            {
                                if( sort - lottery.arr[ j ][0] <= 0  )
                                {
                                    lottery.arr.splice(j, 0, [sort,id] );
                                    break;
                                }
                            }
                        }
                    }
                    else
                    {
                        lottery.arr.push( [data.games[i].sort,id] );
                    }
                }
                function getClickStr(obj)
                {
                    return " onclick=\"__openWin(\'lottery_hall\',\'"+obj.link+"\')\"";
                }
                for (var i = 0; i < count; i++)
                {
                    var obj =  lottery.obj[lottery.arr[i][1]];// it  is a  lottery  object  from Array
                    if(  obj.stop == 1 ) //停用， 维护 中的 彩票不显示 。(暂时先不判断 obj.enable == 1）
                    {
                        continue;
                    }
                    if( i < static_value.topNum )
                    {
                        var hot_li_d_id = "hot_main-item-"+obj.id;
                        var str = "<li class=\"nav-li lot"+obj.id+"\"  data-sort=\""+obj.sort+"\"><a id=\""+hot_li_d_id+"\" class=\"nav-btn cur-btn\" data-argsid=\""+obj.id+"\" title=\""+obj.name+"\" "+getClickStr(obj)+" ><i></i><span class=\"lot-text\">"+obj.name+"</span></a>";
                        hotHtmlArr.push(str);
                        gameIdStr_hot += obj.id + ",";
                    }
                    /////__openWin(\'lottery_trend\',\'/trend/index.html?gameId="+obj.id+
                    var li_d_id = "main-item-"+obj.id;
                    var str = "<li class=\"nav-li lot"+obj.id+"\"  data-sort=\""+obj.sort+"\"><a id=\""+li_d_id+"\" class=\"nav-btn cur-btn\" data-argsid=\""+obj.id+"\" title=\""+obj.name+"\" "+getClickStr(obj)+" ><i></i><span class=\"lot-text\">"+obj.name+"</span></a>";
                    if( obj.freqType == 1 || obj.freqType == "1"  )
                    {//高频彩
                        if( obj.type == 1 || obj.type == "1" )//时时彩
                        {
                            arr1.push(str);
                            gameIdStr1 += obj.id + ",";
                        }
                        else if( obj.type == 2 || obj.type == "2" )//快三
                        {
                            arr2.push(str);
                            gameIdStr2 += obj.id + ",";
                        }
                        else if( obj.type == 3 || obj.type == "3" )//十一选五
                        {
                            arr3.push(str);
                            gameIdStr3 += obj.id + ",";
                        }
                        else if( obj.type == 6 || obj.type == "6" )//PC蛋蛋
                        {
                            arr4.push(str);
                            gameIdStr4 += obj.id + ",";
                        }
                        else if( obj.type == 7 || obj.type == "7" )//新加快乐十分
                        {
                            happy_list.push(str);
                            happy_Str += obj.id + ",";
                        }
                        else
                        {
                            highHtmlArr.push(str);
                        }
                        if(obj.type == 7 || obj.type == "7"){//快乐农场不需要加入高频彩，单独拉出
                        	
                        }else{
                        	gameIdStr_high += obj.id + ",";
                        }
                    }
                    else
                    {//低频彩
                        lowHtmllArr.push(str);
                        gameIdStr_low += obj.id + ",";
                    }
                } // 循环 彩票列表 结束
                $("#hot_lottery .main-tit").data( "gameIdStr",gameIdStr_hot ); //保存热门彩票的 id
                $("#hot_lottery>ul").html( hotHtmlArr.join("")); //热门彩种
                if( arr1.length == 0 )
                {
                    $("#shishicai_ul").css("display","none");
                }
                else
                {
                    $("#shishicai_ul>ul").html( arr1.join("") ); //时时彩
                }
                $("#shishicai_").data( "gameIdStr",gameIdStr1);
                //快三
                if( arr2.length == 0 )
                {
                    $("#kuaisan_ul").css("display","none");
                }
                else
                {
                    $("#kuaisan_ul>ul").html( arr2.join(""));
                }
                $("#kuaisan_").data( "gameIdStr",gameIdStr2 );
                //十一选五
                if( arr3.length == 0 )
                {
                    $("#shiyixuanwu_ul").css("display","none");
                }
                else
                {
                    $("#shiyixuanwu_ul>ul").html( arr3.join(""));
                }
                $("#shiyixuanwu_").data( "gameIdStr",gameIdStr3);
                //PC蛋蛋
                if( arr4.length == 0 )
                {
                    $("#pcdd_ul").css("display","none");
                }
                else
                {
                    $("#pcdd_ul>ul").html( arr4.join(""));
                }
                $("#pcdd_").data( "gameIdStr",gameIdStr4);
                //快乐十分
                $("#happy_lottery .main-tit").data( "gameIdStr",happy_Str);

                
                //高频彩种
                $("#high_lottery>ul").append(highHtmlArr.join(""));
                $("#high_lottery  .main-top").data( "gameIdStr",gameIdStr_high);
                //低频彩种
                $("#low_lottery>ul").html(lowHtmllArr.join(""));
                $("#low_lottery  .main-top").data( "gameIdStr",gameIdStr_low);
                //新加快乐十分
                $("#happy_lottery>ul").html(happy_list.join(""));
                $("#happy_lottery  .main-top").data( "gameIdStr",happy_Str);
                //html 渲染结束后可以删除不用的全局对象中的属性，以 节约内存(测试时，可以屏蔽该行代码)
            },
            error: function (XMLHttpRequest, status) {
                _alert("请求超时");
            }
        });
        ///** 【热门彩种】彩票menu ，张开和收起  **/
        $('#hot_lottery .main-tit').on("click",function(){
            if(  $('#hot_lottery .main-tit>i').attr("class").indexOf("icon-attr-up") >=0  )
            {
                $('#hot_lottery .main-tit>i').removeClass("icon-attr-up");
                $(this).parent().find("ul").hide();
            }
            else
            {
                $('#hot_lottery .main-tit>i').addClass("icon-attr-up");
                $(this).parent().find("ul").show();
            }
        });
        ///** 【高频,低频】彩票menu ，张开和收起  **/
        $('#live-main-list .main-top').on("click",function(){
            if(  $(this).children("i").attr("class").indexOf("icon-attr-up") >=0  )
            {
                $(this).children("i").removeClass("icon-attr-up");
                $(this).parent().find("ul.gao-ul").css("display","none");
            }
            else
            {
                $(this).children("i").addClass("icon-attr-up");
                $(this).parent().find("ul.gao-ul").css("display","block");
            }
        });
        ///** 【新加快乐十分】彩票menu ，张开和收起  **/
        $('#happy_lottery .main-tit').on("click",function(){
            if(  $(this).children("i").attr("class").indexOf("icon-attr-up") >=0  )
            {
                $(this).children("i").removeClass("icon-attr-up");
                $(this).parent().find("ul").css("display","none");
            }
            else
            {
                $(this).children("i").addClass("icon-attr-up");
                $(this).parent().find("ul").css("display","block");
            }
        });
        ///** 【高频二级菜单】彩票menu ，张开和收起  **/
        $('#live-main-list  ul.gao-ul  .icon-attr-down').parent().bind("click",function(){
            if(  $(this).find(".icon-attr-down").attr("class").indexOf("icon-attr-up") >=0  )
            {
                $(this).find(".icon-attr-down").removeClass("icon-attr-up");
                $(this).parent().find("ul").css("display","none");
            }
            else
            {
                $("#live-main-list  ul.gao-ul .icon-attr-down").removeClass("icon-attr-up");
                $("#live-main-list ul.gao-ul>li>ul").css("display","none");
                $(this).find(".icon-attr-down").addClass("icon-attr-up");
                $(this).parent().find("ul").css("display","block");
            }
        });
        ///* 点击头部logo，进入主页 */
        if( $("#live-menu-wrap>.live-logo").length > 0 )
        {
            $("#live-menu-wrap>.live-logo").bind("click",function(){
                __openWin("home","/");
            });
        }
    }
};

//打开注册登录弹窗
function opRegDIV(){
    if( $("#__pup_REG_div").length == 0 )
    {
        $("body").append("<div id=\"__pup_REG_div\"><div><iframe src=\"/register/reg.html\" name=\"_iframe_reg\" scrolling=\"no\" marginwidth=\"0px\" marginwidth=\"0px\" frameborder=\"0\"  samless ></iframe></div></div>");
        $("#__pup_REG_div").css({width:"100%",height:"100%",position:"fixed",zIndex:"15",backgroundColor:"rgba(30,30,30,0.5)",left:"0",top:"0"});
       $("#__pup_REG_div>div").css({width:"650px",marginLeft:"-325px",height:"520px",marginTop:"-260px",position:"absolute",left:"50%",top:"49%"});
        $("#__pup_REG_div iframe").css({width:"100%",height:"100%",margin:"0",display:"block"});
    }
    else
    {
        $("#__pup_REG_div iframe").attr("src","/register/reg.html");
    }
    $("#__pup_REG_div").show();
    if(event.preventDefault){event.preventDefault();}else{event.returnValue = false;}
}
//打开免费试玩弹窗
function opFreePalyDIV(){
    if( $("#__pup_REG_div").length == 0 )
    {
        $("body").append("<div id=\"__pup_REG_div\"><div><iframe src=\"/register/regPlayDiv.html\" name=\"_iframe_reg\" scrolling=\"no\" marginwidth=\"0px\" marginwidth=\"0px\" frameborder=\"0\"  samless ></iframe></div></div>");
        $("#__pup_REG_div").css({width:"100%",height:"100%",position:"fixed",zIndex:"15",backgroundColor:"rgba(30,30,30,0.5)",left:"0",top:"0"});
        $("#__pup_REG_div>div").css({width:"650px",marginLeft:"-325px",height:"595px",marginTop:"-295px",position:"absolute",left:"50%",top:"49%"});
        $("#__pup_REG_div iframe").css({width:"100%",height:"100%",margin:"0",display:"block"});
    }
    else
    {
        $("#__pup_REG_div iframe").attr("src","/register/regPlayDiv.html");
    }
    $("#__pup_REG_div").show();
    if(event.preventDefault){event.preventDefault();}else{event.returnValue = false;}
}

$(function(){
    _lottery_menu.head();
    _lottery_menu.leftMenu();
});


