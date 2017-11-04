// content: 滚动条,以及页面自适应
$(function(){
    //自适应 宽度
    var liveArr = [38,41,43,45,47,85];
    /**
     * game group
     * @param  Object options settings
     * @return Object         return this
     */
    $.fn.gameGroup = function(options) {
        var conf = {
            oldIE: (typeof(oldIE) != 'undefined')? oldIE: false,
            linkEle: ".ctl-btn-enter",       //触发事件
            groupClass: ".ele-live-group",   //连结区域
            triggerEle: [".ele-live-img"],   //触发事件元素
            baseLeft: 0,                     //定位基准左边界
            baseRight: '',                   //定位基准右边界(需要時使用)
            baseBottom: 0,                   //定位基准下边界
            baseTop: '',                     //定位基准上边界(需要時使用)
            inDelay: 300,                    //滑标hover延迟
            outDelay: 300,                   //滑标hover延迟
            showTime: 300                    //动画时间
        };
        $.extend(conf, options);
        if(conf.linkEle) {
            conf.triggerEle.push(conf.linkEle);
        }
        return this.each(function() {
            var timerIn, timerOut,
                group = $(conf.groupClass, this),
                triggerEle = conf.triggerEle.join(",");
            //设定 group位置
            if(conf.baseTop !== '') {
                group.css({top: conf.baseTop});
            }else {
                group.css({bottom: conf.baseBottom});
            }
            if(conf.baseRight !== '') {
                group.css({right: conf.baseRight});
            }else{
                group.css({left: conf.baseLeft});
            }
            group.add(triggerEle, this).hover(function() {
                clearTimeout(timerOut);
                timerIn = setTimeout(function() {
                    if(conf.oldIE) {
                        group.stop().show();
                    }else {
                        group.stop().fadeIn(conf.showTime);
                    }
                }, conf.inDelay);
            }, function() {
                clearTimeout(timerIn);
                timerOut = setTimeout(function() {
                    if(conf.oldIE) {
                        group.stop().css("display", "none");
                    }else {
                        group.stop().fadeOut(conf.showTime);
                    }
                }, conf.outDelay);
            });
        });
    };
    (function() {
        var  newLive = {
            liveData: {},
            mainItem: '',
            clickStatus: true,
            curHall: 38,
            curSub: {},
            ultimateArr: [39,44,46,48,81,83],
            keyString : "",
            groupX : "",
            groupY : "",
            resetClick: function() {
                this.curSub = '';
                this.mainItem = '';
            },
            gameShowHide: function() {
                $(function(){
                    if(newLive.curHall) {
                        // 开启/重刷页面
                        if( $.inArray(newLive.curHall, liveArr) >= 0 )
                        {
                            $('.ele-live-layout').css('display', 'none'); //#ele-live-flash,
                            $('.showhide-wrap, .showhide-' + newLive.curHall).show();
                            return false;
                        }
                        $('.showhide-wrap').css('display', 'none');
                    }
                });
            },
            accDiv : function (num1, num2){
                var t1 = 0,t2 = 0,r1,r2;
                try{t1 = num1.toString().split(".")[1].length} catch(e){}
                try{t2 = num2.toString().split(".")[1].length} catch(e){}
                r1 = Number(num1.toString().replace(".",""));
                r2 = Number(num2.toString().replace(".",""));
                return (r1 / r2) * Math.pow(10, t2 - t1);
            },
            calculateBox: function() {
                var winH = $(window).height() - $('.new-header').height(), //获取内容区高度                
                    winW = $(window).width(),
                    contentWidth = winW - $('#live-menu-wrap').width(),
                    wrapheight = winH ,
                    listheight = winH - $('.live-logo').outerHeight(true) - $('.live-choose').outerHeight(true) + $('.new-header').height() - 2, //获取菜单高度
                    menu_height = $('#live-main-list').find('.live-nav').height();                     
                try{//拉缩屏幕防止出现白边优化
                	if(winW<=980){
                		$(".live-logo").hide();
	                	$("#_lottery_menu_head div").eq(0).hide();	                	
	                	if($("#_lottery_menu_head>button").attr("class")=="_open"){
		                	$("#_lottery_menu_head>button").removeClass("_open");
		                }
	                }else{
	                	$(".live-logo").show();
	                	if($("#_lottery_menu_head>button").attr("class")=="_open"){
		                	$("#_lottery_menu_head div").eq(0).hide();	                		
		                }else{
		                	$("#_lottery_menu_head div").eq(0).show();
		                }
	                }
                }catch(e){console.log(e)}
                
                if (menu_height > listheight) {
                    var height_gap;
                    if ($('#menu-control').hasClass('go-top')) {
                        height_gap = (listheight - menu_height) - 25;
                    } else {
                        height_gap = 0;
                    }
                    $('#live-main-list').addClass('fixed-btn').find('.live-nav').css({ top: height_gap + 'px' });
                } else {
                    $('#live-main-list').removeClass('fixed-btn').find('.live-nav').css('top', '0').end().find('#menu-control').removeClass('go-top');
                }
                $('#live-main-wrap').css({width: contentWidth, minHeight: winH - 12}); //height: winH
                var _height =  wrapheight-$(".new-header").height() ;
                $('#live-main-list').css("height", winH);//左边menu高度控制
                $('#main-wrap').css('width','100%');
                if(  $('.ele-live-layout').length > 1 )
                {
                    var boxWidth = $('.ele-live-layout').width() + 14,   boxNum = Math.floor(this.accDiv(contentWidth, boxWidth));
                    $('#ele-live-wrap').css({width: boxNum * (boxWidth)});
                }
            },

            init: function() {
                // 初始页面 购彩大厅区预设动作
                this.gameShowHide();
                $(window).load(function() {
                    newLive.calculateBox();
                });
                // 缩放视窗
                $( window ).resize(function() {
                  //  $('#main-wrap').css('width',$('#live-menu-wrap').width()+$('#live-main-wrap').width());
                    newLive.calculateBox();
                });
                //如果小于980刷新，防止出现白边
                var winW = $(window).width();
                try{
                	if(winW<=980){
                		$(".live-logo").hide();
	                	$("#_lottery_menu_head>button").trigger("click").removeClass("_open");
	                }
                }catch(e){console.log(e)}                
            }
        }
        newLive.init();
    })();
    (function($){
        $(window).on("load",function(){
            setTimeout(function(){
                $("#live-main-list").mCustomScrollbar({theme:"minimal"});
            },500);
        });
    })(jQuery);
});