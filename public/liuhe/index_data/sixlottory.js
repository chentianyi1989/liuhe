/*----------  globe param for check is sixlottory open or not  ----------*/

(function ($) {
    var _parent = window.parent,
            mainUrl = _parent.location.protocol + '//' + _parent.location.hostname + '/sixGame/statics.html?disthtml=';
    var sixLottory = {
        container: $('#bclass'),
        openOne_selector: "#gd-box1",
        openFivecontainer: $('#gd-box2'),
        bigclass_temp: $("#bigclass-template"),
        iframe: $('#frame'),
        open_five_template: $("#open-five-template"),
        //取得大类
        fetchBigClasses: function () {
            return $.ajax({
                url: '/sixGame/getAllPlay.html',
                type: 'GET',
                dataType: 'json'
            }).promise();
        },
        /*----------  get the lastest one liuhe lottory number /sixGame/getOpenNumberOne.html   ----------*/
        fetchLastOne: function () {
            return $.ajax({
                url: '/sixGame/getOpenNumberOne.html',
                type: 'GET',
                dataType: 'json',
                data: {issue: $('span#current_issue').text()}
            }).promise();
        },
        /*----------  get the lastest Five liuhe lottory number /sixGame/getOpenNumberFive.html----------*/
        fetchLastFive: function () {
            return $.ajax({
                url: '/sixGame/getOpenNumberFive.html',
                type: 'GET',
                dataType: 'json',
                data: {issue: $('span#current_issue').text()}
            }).promise();
        },
        /*----------  get issue and close time for countdown function  ----------*/
        fetchIssue: function () {
            return $.ajax({
                url: '/sixGame/getPeriodAndCloseTime.html',
                type: 'GET',
                dataType: 'json'
            }).promise();
        },
        //渲染导航页面
        render: function (data) {
            var source = this.bigclass_temp.html();
            Handlebars.registerHelper('toherf', function (value) {
                var v;
                switch (value + "") {
                    case '47':
                        v = 'tm';
                        break;
                    case '31':
                        v = 'lm';
                        break;
                    case '32':
                        v = 'sb';
                        break;
                    case '33':
                        v = '12sx';
                        break;
                    case '34':
                        v = 'hx';
                        break;
                    case '35':
                        v = 'tws';
                        break;
                    case '36':
                        v = 'zm';
                        break;
                    case '37':
                        v = 'zmt';
                        break;
                    case '38':
                        v = 'zm16';
                        break;
                    case '39':
                        v = 'wx';
                        break;
                    case '40':
                        v = 'yx';
                        break;
                    case '41':
                        v = 'zx';
                        break;
                    case '42':
                        v = '7sb';
                        break;
                    case '43':
                        v = 'zxs';
                        break;
                    case '44':
                        v = 'zxbz';
                        break;
                    case '45':
                        v = 'dpelx';
                        break;
                    case '46':
                        v = 'mp';
                        break;

                }
                return new Handlebars.SafeString(v);
            });
            var template = Handlebars.compile(source);
            this.container.html(template(data));
        },
        //渲染近一期页面
        renderOpenOne: function (data) {
            $( sixLottory.openOne_selector + "  .color-green").text(data.issue);
            var numArrLength = data.openNumbers.length;
            if( numArrLength <= 1 )
            {
                $( sixLottory.openOne_selector + "  #lt_opentimebox2 strong").html("  正在开奖");
                if( typeof(_sItl_one_1) == "undefined" ||  typeof(_sItl_one_1) == "null" )
                {
                    numHtml();
                    window._sItl_one_1 =  setInterval(numHtml,100);
                }
                if( typeof(_sItl_one_2) == "undefined" ||  typeof(_sItl_one_2) == "null"  )
                {
                    window._sItl_one_2 =  setInterval(function(){
                        $.when( sixLottory.fetchLastOne() ).done(function ( result){
                            try
                            {
                                if ( session_timeout(result) === false )
                                {
                                    return false;
                                }
                            } catch(e){ console.log(e);}
                            sixLottory.renderOpenOne(result);
                        });
                    },60000);
                }
                function  numHtml(){
                    var html = "";
                    for( var p = 0 ; p < 6 ; p++ )
                    {
                        html += "<span><b class=\""+getClassName ( Math.floor( Math.random()*49+1 ) )+"\"></b><i></i></span>";
                    }
                    html += "<span class=\"plus\">+</span>" + "<span><b class=\""+getClassName ( Math.floor( Math.random()*49+1 ) )+"\"></b><i></i></span>"
                    $( sixLottory.openOne_selector + "  #result_balls").html( html );
                }
            }
            else
            {
                $( this.openOne_selector + "  #lt_opentimebox2 strong").html("");
                (function(data){
                    var html = "";
                    for( var p = 0 ; p < numArrLength-1 ; p++ )
                    {
                        html += "<span><b class=\""+getClassName ( data.openNumbers[p].number )+"\"></b><i>"+data.openNumbers[p].animal+"</i></span>";
                    }
                    html += "<span class=\"plus\">+</span>" + "<span><b class=\""+getClassName ( data.openNumbers[numArrLength-1].number )+"\"></b><i>"+data.openNumbers[numArrLength-1].animal+"</i></span>"
                    $( sixLottory.openOne_selector + "  #result_balls").html( html );
                })(data);

                if( typeof(_sItl_one_1) != "undefined" &&  typeof(_sItl_one_1) != "null" )
                {
                    clearInterval(_sItl_one_1);
                    delete  window._sItl_one_1;
                }
                if( typeof(_sItl_one_2) != "undefined" &&  typeof(_sItl_one_2) != "null" )
                {
                    // 如果存在定时刷新最新一期的开奖号码的定时器，则刷新前五期的开奖号码 （页面初始化已经刷新过前五期，这里只有，当存在刷新最新期定时器的时候，才再次刷新前五期）
                    $.when( sixLottory.fetchLastFive() ).done(function ( result){
                        try
                        {
                            if ( session_timeout(result) === false )
                            {
                                return false;
                            }
                        } catch(e){ console.log(e);}
                        var openFive = result;
                        for (var i = 0; l = openFive.length, i < l; i++) {
                            var lastFiveObj = openFive[i].openNumbers.pop();
                            openFive[i].lastNumber = lastFiveObj.number;
                            openFive[i].lastAnimal = lastFiveObj.animal;
                        }
                        sixLottory.renderOpenFive(openFive);
                    });
                    clearInterval(_sItl_one_2);
                    delete  window._sItl_one_2;
                }
            }
            function getClassName( num )
            {
                return ( num < 10 ? ("b0" + num ) : ("b" + num ) );
            }
        },
        //渲染近五期页面
        renderOpenFive: function (data) {
            var source = this.open_five_template.html();
            Handlebars.registerHelper('both', function (value) {
                var v = Number(value);
                var results = (v < 10 ? ("0" + v) : v);
                return new Handlebars.SafeString(results);
            });
            var template = Handlebars.compile(source);
            this.openFivecontainer.html(template(data));
        },
        bindEventIssue: function () {
            $('#showgd-box').find('ul').find('li').on('click', function (event) {
                try{if(event.preventDefault){event.preventDefault();}else{event.returnValue = false;}}catch(e){}
                $el = $(this);
                var index = $(this).find('a').attr('index');
                switch (index) {
                    case '1':
                        $el.find('a').addClass('tabulous_active').end().siblings('li').find('a').removeClass('tabulous_active');
                        $('#gd-box1').attr('class', 'make_transist');
                        $('#gd-box2').attr('class', 'hideleft');
                        break;
                    case '2':
                        $el.find('a').addClass('tabulous_active').end().siblings('li').find('a').removeClass('tabulous_active');
                        $('#gd-box1').attr('class', 'hideleft');
                        $('#gd-box2').attr('class', 'make_transist');
                        break;
                }
            });
        },
        orderscoll: function () {
            var top = Number($('#orderlist').css('top').split('px')[0]);
            $(window).on('scroll', function () {
                $('#orderlist').stop().animate({'top': top + $(this).scrollTop()}, 500, 'linear');
            });
        },
        //绑定导航按钮
        bindEvent: function () {
            var _self = this,
                    $a = $('#bclass').find('a'),
                    frame = $('div.frame', '#main');
            $a.eq(0).addClass('active');
            $a.on('click', function (e) {
                try{if(e.preventDefault){e.preventDefault();}else{e.returnValue = false;}}catch(e){}
                var playId = $(this).attr('playId');
                switch (playId) {
                    case '47':
                        frame.css({'height': 770 + 'px'});
                        break;
                    case '31':
                        frame.css({'height': 515 + 'px'});
                        break;
                    case '32':
                        frame.css({'height': 635 + 'px'});
                        break;
                    case '33':
                        frame.css({'height': 565 + 'px'});
                        break;
                    case '34':
                        frame.css({'height': 565 + 'px'});
                        break;
                    case '35':
                        frame.css({'height': 565 + 'px'});
                        break;
                    case '36':
                        frame.css({'height': 615 + 'px'});
                        break;
                    case '37':
                        frame.css({'height': 700 + 'px'});
                        break;
                    case '38':
                        frame.css({'height': 765 + 'px'});
                        break;
                    case '39':
                        frame.css({'height': 565 + 'px'});
                        break;
                    case '40':
                        frame.css({'height': 565 + 'px'});
                        break;
                    case '41':
                        frame.css({'height': 566 + 'px'});
                        break;
                    case '42':
                        frame.css({'height': 565 + 'px'});
                        break;
                    case '43':
                        frame.css({'height': 565 + 'px'});
                        break;
                    case '44':
                        frame.css({'height': 660 + 'px'});
                        break;
                    case '45':
                        frame.css({'height': 565 + 'px'});
                        break;
                    case '46':
                        frame.css({'height': 690 + 'px'});
                        break;
                }
                $(this).addClass('active').siblings('a').removeClass('active');
                _self.iframe.attr('src', mainUrl + $(this).attr('data-href'));
            });
        }
    };

    $.when(sixLottory.fetchIssue()).then(function (result) {
        if (result.status === 1000) {
            $('span#current_issue').text(result.issue);
            $('p.time-title').text('已开盘,欢迎投注。距离关盘还有');
            countdownTime(result.timeCount);
        } else if (result.status === 1001) {
            $('span#current_issue').text(result.issue);
            $('p.time-title').text('本期已关盘,距离下期开盘还有');
           // $('#lottory_open').val('false');
            countdownTime(result.timeCount);
        }
        $.when(sixLottory.fetchBigClasses(), sixLottory.fetchLastOne(), sixLottory.fetchLastFive()).then(function (results, result1, result3) {
            var openOne = result1[0],openFive = result3[0];
            for (var i = 0; l = openFive.length, i < l; i++) {
                var lastFiveObj = openFive[i].openNumbers.pop();
                openFive[i].lastNumber = lastFiveObj.number;
                openFive[i].lastAnimal = lastFiveObj.animal;
            }
            sixLottory.render(results[0].data);
            $('#frame').attr('src', mainUrl + $('#bclass').find('a').first().attr('data-href'));
            sixLottory.renderOpenOne(openOne);
            sixLottory.renderOpenFive(openFive);
            sixLottory.bindEvent();
            sixLottory.bindEventIssue();
            sixLottory.orderscoll();
            if ($('#lottory_open').val() === 'false') {
                return;
            }
            var totalhidden = $('#totalhidden'),
                    total = $('#btotal');
            //绑定下注详单中input值变化 change
            $('body').on('keyup', '.changeValue', function () {
                var value = Math.abs($(this).val()) === 'NaN' ? '' : Math.abs($(this).val());
                var totalhidden = Number($('#totalhidden').val()),
                        total = 0;
                $('.changeValue').each(function () {
                    total = total + Number($(this).val());
                });
                $('#btotal').text("总金额:" + total);
            });
            // 绑定下注单中checkbox的变化
            $('body').on('click', '.checkChange', function () {
                $(this).parent().prev().find('input').toggleClass('changeValue');
                var totalhidden = Number($('#totalhidden').val()),
                        total = 0,
                        changeValue = $('.changeValue');
                changeValue.each(function () {
                    total = total + Number($(this).val());
                });
                $('#bcount').text("组数:" + changeValue.size());
                $('#btotal').text("总金额:" + total);
            });
        });
    });
    /*----------  倒计时功能  ----------*/
    //倒计时
    function countdownTime(time) {
        var $h1 = $('#count_down').find('span.leaveh-1'),
                $h2 = $('#count_down').find('span.leaveh-2'),
                $m1 = $('#count_down').find('span.leavem-1'),
                $m2 = $('#count_down').find('span.leavem-2'),
                $s1 = $('#count_down').find('span.leaves-1'),
                $s2 = $('#count_down').find('span.leaves-2');
        var t = time * 1000;
        var d, h, m, s;
        var end = new Date().getTime() + t;
        if (t > 0) {
            CDTime = setInterval(function () {
                t = end - new Date().getTime();
                d = Math.floor(t / (24 * 3600 * 1000));
                if (t > 0) {
                    h = Math.floor(t / 1000 / 60 / 60 % 24) + d * 24;
                    // h = Math.floor(t / 1000 / 60 / 60 % 24);
                    if (h < 10) {
                        // h = "0" + h;
                        $h1.text('0');
                        $h2.text(h);
                    } else {
                        h = h + '';
                        $h1.text(h.substr(0, 1));
                        $h2.text(h.substr(1, 2));
                    }
                    m = Math.floor(t / 1000 / 60 % 60);
                    if (m < 10) {
                        $m1.text('0');
                        $m2.text(m);
                    } else {
                        m = m + '';
                        $m1.text(m.substr(0, 1));
                        $m2.text(m.substr(1, 2));
                    }
                    s = Math.floor(t / 1000 % 60);
                    if (s < 10) {
                        $s1.text('0');
                        $s2.text(s);
                    } else {
                        s = s + '';
                        $s1.text(s.substr(0, 1));
                        $s2.text(s.substr(1, 2));
                    }
                } else {
                    clearInterval(CDTime);
                    window.location.reload();
                }
            }, 1000);
        }
    }

})(jQuery);

/*----------  确定提交投注 ----------*/
function confirmBet() {
    var modal = document.getElementById('betModal'),
            $input = $('.changeValue'),
            dataArray = [],
            totalMoney = 0,
            flag = true,
            listArray = [];
    $input.each(function (index, el) {
        if ($(el).val() === '' || $(el).val() === '0') {
            flag = false;
            alert('每项金额必须大于0！！');
        }
    });
    if (!flag) {
        return;
    }
    $input.each(function (index, el) {
        var methodid = $(el).attr('methodid'),
                type = $(el).attr('types'),
                money = $(el).val(),
                codes = $(el).attr('codes'),
                odds = $(el).attr('odds'),
                tab = $(el).attr('tab');
        if (tab) {
            if (Number(codes)) {
                str = '{"methodid":"' + methodid + '","type":" ' + type + '","tab":"' + tab + '","money":"' + money + '","codes":"' + codes + '","prize":"' + odds + '"}';
            } else {
                str = '{"methodid":"' + methodid + '","type":" ' + type + '","money":"' + money + '","codes":"' + codes + '","prize":"' + odds + '"}';
            }
            str2 = '{"methodid":"' + methodid + '","odds":" ' + odds + '","type":" ' + type + tab.toUpperCase() + '","tab":"' + tab + '","money":"' + money + '","codes":"' + codes + '"}';
        } else {
            str = '{"methodid":"' + methodid + '","type":" ' + type + '","money":"' + money + '","codes":"' + codes + '","prize":"' + odds + '"}';
            str2 = '{"methodid":"' + methodid + '","odds":" ' + odds + '","type":" ' + type + '","money":"' + money + '","codes":"' + codes + '"}';
        }
        dataArray.push(JSON.parse(str));
        listArray.push(JSON.parse(str2));
        totalMoney = totalMoney + Number(money);
    });
    data = {
        "data": dataArray
    }
    if (totalMoney === 0) {
        alert('总金额要大于0');
        return;
    }
    modal.style.display = "none";
    //CHECK USER HAS LOGIN OR NO
    $.ajax({
        beforeSend: function (xhr) {
            if( $('#'+balance_span).length == 0 )
            {
                var temp_t = $('#'+balance_span,parent.document).text();
            }
            else
            {
                var temp_t = $('#'+balance_span).text();
            }
            balance = (temp_t.indexOf("￥")>=0) ? (temp_t.split('￥')[1].split(',').join('')) : (temp_t.split(',').join(''));
            var modal = document.getElementById("myModal"),
                    span = document.getElementsByClassName("close")[0],
                    btnclose = document.getElementById("closebtn") ? document.getElementById("closebtn") :$(modal).find("button").get(0);
            span.onclick = function () {
                modal.style.display = "none";
            }
            btnclose.onclick = function () {
                modal.style.display = "none";
            }
/*            if( _user_ &&_user_.isLogin == "false" ){
                _alert("对不起,您未登录或已自动退出！");
                $('#username').focus();
                 return false;
            }*/
            if (totalMoney > Number(balance)) {
                $('div#myModal').show().find('p#content').html('对不起,余额不足请及时充值！');
                xhr.abort();
            } else {
                btnclose.style.display = "none";
                $('div#myModal').show().find('#closex').hide().end().find('p#content').text('请稍等正在投注。。。。。。');
            }
        },
        url: '/sixGame/saveBet.html',
        type: 'POST',
        dataType: 'json',
        timeout: 30000,
        data: data
    }).done(function (data) {
        try
        {
            if ( session_timeout(data) === false )
            {
                return false;
            }
        } catch(e){ console.log(e);}
        //1001 余额不足
        //1002  本期已关闭
        //1003 该用户已被禁用
        //1004  赔率和返点值错误
        //1005  服务器内部错误
        var modal = document.getElementById("myModal"),
                span = document.getElementsByClassName("close")[0],
            btnclose = document.getElementById("closebtn") ? document.getElementById("closebtn") :$(modal).find("button").get(0),
                closex = document.getElementById('closex');
        span.onclick = function () {
            modal.style.display = "none";
        }
        btnclose.onclick = function () {
            modal.style.display = "none";
        }
        sixlottory_timeout(data);
        if (data.status === 1000) { //1000 代表成功下注
            var arr = data.orderList;
            for (var prop in arr) {
                listArray[prop].orderId = arr[prop].orderId;
            }
            btnclose.style.display = "none";
            $('div#myModal').find('p#content').text('恭喜，下注成功！！！').end().delay(800).fadeOut(200, function () {
                btnclose.style.display = "";
                closex.style.display = "";
            });
            parent._user_.refreshMoney("#balance");
           // var source = $('#listdetail-template').html(),
                   // template = Handlebars.compile(source);
           //$('#orderlist').removeClass('hidden').find('ul#betReulstList').prepend(template(listArray));
        } else if (data.status === '1001') {
            btnclose.style.display = "";
            closex.style.display = "";
            $('div#myModal').find('p#content').html(data.msg);
            return;
        } else if (data.status === 1002) {
            btnclose.style.display = "";
            closex.style.display = "";
            $('div#myModal').find('p#content').text(data.msg);
            return;
        } else if (data.status === 1003) {
            btnclose.style.display = "";
            closex.style.display = "";
            $('div#myModal').find('p#content').text(data.msg);
            return;
        } else if (data.status === 1004) {
            btnclose.style.display = "";
            closex.style.display = "";
            $('div#myModal').find('p#content').text(data.msg);
            return;
        } else if (data.status === 1005) {
            btnclose.style.display = "";
            closex.style.display = "";
            $('div#myModal').find('p#content').text(data.msg);
            return;
        } else if (data.status === 1006) {
            btnclose.style.display = "";
            closex.style.display = "";
            $('div#myModal').find('p#content').text(data.msg);
            return;
        }

    }).fail(function (jqXHR, status) {
        var modal = document.getElementById("myModal"),
                span = document.getElementsByClassName("close")[0],
            btnclose = document.getElementById("closebtn") ? document.getElementById("closebtn") :$(modal).find("button").get(0);
        span.onclick = function () {
            modal.style.display = "none";
        }
        btnclose.onclick = function () {
            modal.style.display = "none";
        }
        sixlottory_process_timeout(status);

    });
}

function sixlottory_timeout(data) {
    var modal = document.getElementById("myModal"),
            span = document.getElementsByClassName("close")[0],
        btnclose = document.getElementById("closebtn") ? document.getElementById("closebtn") :$(modal).find("button").get(0),
            closex = document.getElementById('closex');
    span.onclick = function () {
        modal.style.display = "none";
    }
    btnclose.onclick = function () {
        modal.style.display = "none";
    }
    btnclose.style.display = "";
    closex.style.display = "";
    if (!isJson(data)) {
        $('div#myModal').find('p#content').text('对不起,系统异常。请联系客服！');
        return true;
    }
    var ref_url = window.location.pathname;
    if (data.is_timeout == 'timeout') {
        $('div#myModal').find('p#content').text('对不起,您已退出请重新登陆！');
        setTimeout(function()
        {
            __openWin('login','/index/login.html?ref_url='+ ref_url);
        }, 1000);
        return false;
    }
    if (data.Result == false) {
        $('div#myModal').find('p#content').text(data.Desc);
        return false;
    }
}

function sixlottory_process_timeout(status) {
    var modal = document.getElementById("myModal"),
            span = document.getElementsByClassName("close")[0],
        btnclose = document.getElementById("closebtn") ? document.getElementById("closebtn") :$(modal).find("button").get(0),
            closex = document.getElementById('closex');
    span.onclick = function () {
        modal.style.display = "none";
    }
    btnclose.onclick = function () {
        modal.style.display = "none";
    }
    btnclose.style.display = "";
    closex.style.display = "";
    if (status == 'timeout') {
        ajaxTimeout.abort();
        $('div#myModal').find('p#content').text('系统繁忙,请重新操作!');
        return false;
    }
    return false;
}

function closeConfirm() {
    var modal = document.getElementById('betModal');
    modal.style.display = "none";
}
