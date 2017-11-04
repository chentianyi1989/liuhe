//下面是静态资源url的前缀

String.prototype.trim = function () {
    return this.replace(/(?:^\s*)|(?:\s*$)/g, "")
};
try{
    if( typeof (pri_imgserver)=="undefined" ||  typeof (pri_imgserver)=="null" || pri_imgserver== "" )
    {
        pri_imgserver = ( typeof(_prefixURL)=="object" && _prefixURL.hasOwnProperty("statics") &&  _prefixURL.statics!="" ) ? _prefixURL.statics : "/500vip/statics";
    }
}catch(e){console.log(e);}
function selectAll(a) {
    jQuery(":checkbox[id!='" + a + "']").attr("checked", jQuery("#" + a).attr("checked"))
}
function validateUserName(b) {
    var a = /^[0-9a-zA-Z]{6,16}$/;
    if (a.exec(b)) {
        return true;
    } else {
        return false;
    }
}
function validateUserPss(b) {
    var a = /^[0-9a-zA-Z]{6,16}$/;
    if (!a.exec(b)) {
        return false;
    }
    a = /^\d+$/;
    if (a.exec(b)) {
        return false;
    }
    a = /^[a-zA-Z]+$/;
    if (a.exec(b)) {
        return false;
    }
    a = /(.)\1{2,}/;
    if (a.exec(b)) {
        return false;
    }
    return true;
}
function validateNickName(b) {
    var a = /^(.){2,8}$/;
    if (a.exec(b)) {
        return true;
    } else {
        return false;
    }
}
function JsRound(c, a, b) {
    a = parseInt(a, 10);
    if (a < 0) {
        a = Math.abs(a);
        return Math.round(Number(c) / Math.pow(10, a)) * Math.pow(10, a);
    } else {
        if (a == 0) {
            return Math.round(Number(c));
        }
    }
    c = Math.round(Number(c) * Math.pow(10, a)) / Math.pow(10, a);
    if (b && b == true) {
        var e = "", d = 0;
        c = c.toString();
        if (c.indexOf(".") == -1) {
            c = "" + c + ".0";
        }
        data = c.split(".");
        for (d = data[1].length; d < a; d++) {
            e += "0"
        }
        return"" + c + "" + e;
    }
    return c
}
function moneyFormat(b, sta) {
    if ((sta || sta == 0) && sta != 1) {
        return '-';
    }
    sign = Number(b) < 0 ? "-" : "";
    b = b.toString().replace(/[^\d.]/g, "");
    b = b.replace(/\.{2,}/g, ".");
    b = b.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
    if (b.indexOf(".") != -1) {
        var c = b.split(".");
        c[0] = c[0].substr(0, 15);
        var a = [];
        for (i = c[0].length; i > 0; i -= 3) {
            a.unshift(c[0].substring(i, i - 3))
        }
        c[0] = a.join(",");
        b = c[0] + "." + (c[1].substr(0, 3))
    } else {
        b = b.substr(0, 15);
        var a = [];
        for (i = b.length; i > 0; i -= 3) {
            a.unshift(b.substring(i, i - 3))
        }
        b = a.join(",") + ".000"
    }
    return sign + b
}
//投注页面赔率显示位三位数字，第四位四舍五入
function formatPrize(pri) {
    var tmpP = tmpPrize.substring(0, tmpPrize.indexOf(".") + 4);
    var tmpNext = pri.substr(pri.indexOf(".") + 4, 1);
    if (tmpNext != null && tmpNext != undefined && tmpNext != '' && tmpNext > 4) {
        tmpP = parseFloat(tmpP) + 0.001;
        tmpP = tmpP.toFixed(3);
    }
    return tmpP;
}
function accDiv(arg1, arg2) {
    var t1 = 0, t2 = 0, r1, r2;
    try {
        t1 = arg1.toString().split(".")[1].length
    } catch (e) {
    }
    try {
        t2 = arg2.toString().split(".")[1].length
    } catch (e) {
    }
    with (Math) {
        r1 = Number(arg1.toString().replace(".", ""))
        r2 = Number(arg2.toString().replace(".", ""))
        return (r1 / r2) * pow(10, t2 - t1);
    }
}

/**
 * 
 * @param {type} arg1
 * @param {type} arg2
 * @returns {Number}
 * 乘法精确运算
 */
function accMul(arg1, arg2) {
    var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
    try {
        m += s1.split(".")[1].length;
    }
    catch (e) {
    }
    try {
        m += s2.split(".")[1].length;
    }
    catch (e) {
    }
    return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m);
}
function formatFloat(a) {
    a = a.replace(/^[^\d]/g, "");
    a = a.replace(/[^\d.]/g, "");
    a = a.replace(/\.{2,}/g, ".");
    a = a.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
    if (a.indexOf(".") != -1) {
        var b = a.split(".");
        a = (b[0].substr(0, 15)) + "." + (b[1].substr(0, 2))
    } else {
        a = a.substr(0, 15)
    }
    return a
}
Array.prototype.each = function (f) {
    f = f || Function.K;
    var b = [];
    var c = Array.prototype.slice.call(arguments, 1);
    for (var e = 0; e < this.length; e++) {
        var d = f.apply(this, [this[e], e].concat(c));
        if (d != null) {
            b.push(d)
        }
    }
    return b
};
Array.prototype.uniquelize = function () {
    var b = new Array();
    for (var a = 0; a < this.length; a++) {
        if (!b.contains(this[a])) {
            b.push(this[a])
        }
    }
    return b
};
Array.complement = function (d, c) {
    return Array.minus(Array.union(d, c), Array.intersect(d, c))
};
Array.intersect = function (d, c) {
    return d.uniquelize().each(function (a) {
        return c.contains(a) ? a : null
    })
};
Array.minus = function (d, c) {
    return d.uniquelize().each(function (a) {
        return c.contains(a) ? null : a
    })
};
Array.union = function (d, c) {
    return d.concat(c).uniquelize()
};
Array.randDiff = function (a, b) {
    var c = new Array();
    var r = 0;
    if (a.length < b) {
        return c;
    } else if (a.length == b) {
        return a;
    }
    for (var i = 0; i < b; i++) {
        r = parseInt(Math.random() * a.length);
        while (c.contains(a[r])) {
            r = parseInt(Math.random() * a.length);
        }
        c.push(a[r]);
    }
    return c;
};
Array.prototype.contains = function (b) {
    for (var a = 0; a < this.length; a++) {
        if (this[a] == b) {
            return true;
        }
    }
    return false;
};
Array.prototype.remove = function (b) {
    for (var a = 0; a < this.length; a++) {
        if (this[a] == b) {
            this.splice(a, 1)
        }
    }
};
function Combination(c, b) {
    b = parseInt(b);
    c = parseInt(c);
    if (b < 0 || c < 0) {
        return false;
    }
    if (b == 0 || c == 0) {
        return 1
    }
    if (b > c) {
        return 0
    }
    if (b > c / 2) {
        b = c - b
    }
    var a = 0;
    for (i = c; i >= (c - b + 1); i--) {
        a += Math.log(i)
    }
    for (i = b; i >= 1; i--) {
        a -= Math.log(i)
    }
    a = Math.exp(a);
    return Math.round(a)
}
function movestring(a) {
    var h = "";
    var k = "01";
    var b = "";
    var f = "";
    var j = "";
    var g = false;
    var c = false;
    for (var e = 0; e < a.length; e++) {
        if (g == false) {
            h += a.substr(e, 1)
        }
        if (g == false && a.substr(e, 1) == "1") {
            c = true
        } else {
            if (g == false && c == true && a.substr(e, 1) == "0") {
                g = true
            } else {
                if (g == true) {
                    b += a.substr(e, 1)
                }
            }
        }
    }
    h = h.substr(0, h.length - 2);
    for (var d = 0; d < h.length; d++) {
        if (h.substr(d, 1) == "1") {
            f += h.substr(d, 1)
        } else {
            if (h.substr(d, 1) == "0") {
                j += h.substr(d, 1)
            }
        }
    }
    h = f + j;
    return h + k + b
}
function getCombination(o, c) {
    var l = o.length;
    var r = new Array();
    var f = new Array();
    if (c > l) {
        return r
    }
    if (c == 1) {
        return o
    }
    if (l == c) {
        r[0] = o.join(",");
        return r
    }
    var a = "";
    var b = "";
    var s = "";
    for (var g = 0; g < c; g++) {
        a += "1";
        b += "1"
    }
    for (var e = 0; e < l - c; e++) {
        a += "0"
    }
    for (var d = 0; d < c; d++) {
        s += o[d] + ","
    }
    r[0] = s.substr(0, s.length - 1);
    var h = 1;
    s = "";
    while (a.substr(a.length - c, c) != b) {
        a = movestring(a);
        for (var d = 0; d < l; d++) {
            if (a.substr(d, 1) == "1") {
                s += o[d] + ","
            }
        }
        r[h] = s.substr(0, s.length - 1);
        s = "";
        h++
    }
    return r
}
function SetCookie(b, c, a) {
    var d = new Date();
    d.setTime(d.getTime() + (a * 1000));
    document.cookie = b + "=" + escape(c) + ";expires=" + d.toUTCString()
}
function getCookie(b) {
    var a = document.cookie.match(new RegExp("(^| )" + b + "=([^;]*)(;|$)"));
    if (a != null) {
        return unescape(a[2])
    }
    return null
}
function delCookie(a) {
    var c = new Date();
    c.setTime(c.getTime() - 1);
    var b = getCookie(a);
    if (b != null) {
        document.cookie = a + "=" + b + ";expires=" + c.toGMTString()
    }
}
function addItem(d, c, a) {
    var b = new Option(c, a);
    d.options.add(b)
}
function SelectItem(d, c) {
    var b = d.options.length;
    for (var a = 0; a < b; a++) {
        if (d.options[a].value == c) {
            d.options[a].selected = true;
            return true;
        }
    }
}

$(function () {
    $("#mq_span").click(function () {
        var features = 'height=600,width=800,top=0, left=0,scrollbars=yes,resizable=yes';
        window.open('/innerMsg/index.html', 'HotNewsHistory', features);
    });
});


/**
 * 转换号码显示
 * @param number
 * @returns {string}
 */
function switchKlpkNum(number) {
    if (number == '')
        return '';
    var arrNum = number.split('|');
    var iniNum = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    var color = ['black', 'red', 'black', 'red'];
    var arrType = ['♠', '♥', '♣', '♦'];
    var strNum = '';
    $.each(arrNum, function (k, v) {
        var span = '';
        var i = parseInt(v.substring(0, 1));
        var n = parseInt(v.substring(1, 3));
        span = '<span style="color:' + color[i - 1] + ';"><em style="font-size:16px;">' + arrType[i - 1] + '</em>' + iniNum[n - 1] + '</span>&nbsp;';
        strNum += span;
    });
    return strNum;
}
function switchKlpkOneNum(number, font) {
    if (number == '')
        return '';
    if (!arguments[1])
        font = "16";
    var iniNum = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    var color = ['black', 'red', 'black', 'red'];
    var arrType = ['♠', '♥', '♣', '♦'];
    var span = '';
    var i = parseInt(number.substring(0, 1));
    var n = parseInt(number.substring(1, 3));
    span = '<span style="color:' + color[i - 1] + ';"><em style="font-size:' + font + 'px;">' + arrType[i - 1] + '</em>' + iniNum[n - 1] + '</span>&nbsp;';
    return span;
}

/**
 * 注单详情
 * @param detail
 */
function showBetDetail(detail) {
    var detailArr = detail.split('&');
    var betArr = new Array();
    for (var i = 0; i < detailArr.length; i++) {
        var tmpData = detailArr[i].split('=');
        var name = tmpData[0];
        var val = tmpData[1];
        betArr[name] = val;
    }

    var posChArr = new Array('万', '千', '百', '十', '个');
    var position = decodeURIComponent(betArr['pos']);
    if (position == 'null') {
        position = '';
    }
    if (position != null && position != undefined && position != '') {
        var posArr = position.split('&');
        position = '';
        for (var i = 0; i < posArr.length; i++) {
            position += (position == '') ? '' : '、';
            position += posChArr[posArr[i]];
        }
    }
    if (position != null && position != undefined && position != '') {
        position = '(' + position + ')';
    }

    var status = '';
    if (betArr['status'] == 0) {
        var rewardMoney = 0;
        var winMoney = 0;
        var trueWinMoney = 0;
        status = '未开奖';
    } else if (betArr['status'] == 1) {
        var rewardMoney = (betArr['amount'] * betArr['reward']).toFixed(3);
        var winMoney = (betArr['win'] == undefined || betArr['win'] == null || betArr['win'] == '') ? 0 : betArr['win'];
        var trueWinMoney = _common.util.Math_sub(Number(_common.util.Math_add(Number(winMoney), Number(rewardMoney))), Number(betArr['amount']));
        if (trueWinMoney > 0 && trueWinMoney.toString().split(".").length > 1) {
            if (trueWinMoney.toString().split(".")[1].length > 3) {
                trueWinMoney = _common.util.Math_add(Number(_common.util.Math_sub(Number(winMoney), Number(betArr['amount']))), Number(rewardMoney));
            }
        }
        var clear = '';
        if (betArr['iswin'] == 4) {
            clear = '和局';//六合彩
        } else {
            winMoney > 0 ? clear = '中奖' : clear = '未中奖';
        }
        status = '已结算（' + clear + ')';
    } else if (betArr['status'] == 2) {
        var rewardMoney = 0;
        var winMoney = 0;
        var trueWinMoney = 0;
        status = '退码';
    } else if (betArr['status'] == 4) {
        var rewardMoney = 0;
        var winMoney = 0;
        var trueWinMoney = 0;
        status = '注单异常';
    }
    if (betArr['iswin'] == 4) {
        var trueWinMoney = 0;
    }
    var openNum = decodeURIComponent(betArr['openNum']);
    if (betArr['gameid'] == '19') {
        openNum = switchKlpkNum(openNum);
    }
    if (openNum == '') {
        openNum = '尚未开奖';
    }
    //奖金返点
    var prizeback = betArr['prize'] + '/' + (betArr['reward'] * 100).toFixed(2) + '%';
    var ids = new Array(68, 58, 61, 63, 65, 92, 95, 97, 99, 102, 135, 137, 987, 991);
    if ($.inArray(parseInt(betArr['psubid']), ids) >= 0) {
        var pid = parseInt(betArr['psubid']);
        var str = '';
        if (pid == 58 || pid == 92) {//前三后三直选
            str += '三星' + betArr['prize'] + '/' + (betArr['reward'] * 100).toFixed(1)  +'%' + '<br>';
            str += '二星' + betArr['prize1'] + '/' +  (betArr['reward'] * 100).toFixed(1) +'%'+ '<br>';
            str += '一星' + betArr['prize2'] + '/' +  (betArr['reward'] * 100).toFixed(1)+'%'+ '<br>';
        } else if ($.inArray(pid, new Array(61, 95, 63, 65, 97, 92, 99, 135, 137)) >= 0) {
            str += '组三' + betArr['prize'] + '/' +  (betArr['reward'] * 100).toFixed(1) +'%'+ '<br>';
            str += '组六' + betArr['prize1'] + '/' +  (betArr['reward'] * 100).toFixed(1) +'%'+ '<br>';
        } else if (pid == 68 || pid == 102) {
            str += '豹子' + betArr['prize'] + '/' +  (betArr['reward'] * 100).toFixed(1) +'%'+ '<br>';
            str += '顺子' + betArr['prize1'] + '/' + (betArr['reward'] * 100).toFixed(1) +'%'+ '<br>';
            str += '对子' + betArr['prize2'] + '/' + (betArr['reward'] * 100).toFixed(1) +'%'+ '<br>';
        } else if (pid == 987) {
            str += '中二' + betArr['prize'] + '/' +  (betArr['reward'] * 100).toFixed(1) +'%'+ '<br>';
            str += '中三' + betArr['prize1'] + '/' + (betArr['reward'] * 100).toFixed(1) +'%' + '<br>';
        } else if (pid == 991) {
            str += '中特' + betArr['prize'] + '/' +  (betArr['reward'] * 100).toFixed(1) +'%' + '<br>';
            str += '中二' + betArr['prize1'] + '/' +  (betArr['reward'] * 100).toFixed(1) +'%' + '<br>';
        }
          prizeback = str;
        $("#dia_win").html(str);
       
    }

    var strUser = $('#welcSpan').html();
    strUser = strUser == undefined ? betArr['username'] : strUser;
    var txtHtml = '<h4>注单号：' + betArr['oid'] + '</h4>'
            + '<div class="data data-order">'
            + '<table border=0 cellspacing=0 cellpadding=0 width=100% heigth="800px">'
            + '<tr class=hid>'
            + '<td width=66>账号：</td>'
            + '<td width=100>' + strUser + '</td>'
            + '<td width=66>单注金额：</td>'
            + '<td width=100>' + moneyFormat(accDiv(betArr['amount'], betArr['count']).toFixed(3)) + '</td>'
            + '</tr>'
            + '<tr class=hid>'
            + '<td width=66>下注时间：</td>'
            + '<td width=100>' + decodeURIComponent(betArr['cTimeTEXT']).replace('+', ' ') + '</td>'
            + '<td width=66>投注注数：</td>'
            + '<td width=100>' + decodeURIComponent(betArr['count']) + '</td>'
            + '</tr>'
            + '<tr class=hid>'
            + '<td width=66>彩种：</td>'
            + '<td width=100>' + decodeURIComponent(betArr['gname']) + '</td>'
            + '<td width=66>投注总额：</td>'
            + '<td width=100>' + moneyFormat(betArr['amount']) + '</td>'
            + '</tr>'
            + '<tr class=hid>'
            + '<td width=66>期号：</td>'
            + '<td width=100>' + betArr['Period'] + '</td>'
            + '<td width=66>奖金/返点：</td>'
            + '<td width=100 id="dia_win">' + prizeback + '</td>'
            + '</tr>'
            + '<tr class=hid>'
            + '<td width=66>玩法：</td>'
            //.replace(/复式|单式/, "单/复式")这个业务不要求显示
            + '<td width=100>' + decodeURIComponent(betArr['pname']) + '</td>'
            + '<td width=66>销售返点：</td>'
            + '<td width=100>' + moneyFormat(rewardMoney, betArr['status']) + '</td>'
            + '</tr>'
            + '<tr class=hid>'
            + '<td width=66>开奖号码：</td>'
            + '<td width=100>' + openNum + '</td>'
            + '<td width=66>中奖金额：</td>'
            + '<td width=100>' + moneyFormat(winMoney, betArr['status']) + '</td>'
            + '</tr>'
            + '<tr class=hid>'
            + '<td width=66>状态：</td>'
            + '<td width=100>' + status + '</td>'
            + '<td width=66>盈亏：</td>'
            + '<td width=100>' + moneyFormat(trueWinMoney, betArr['status']) + '</td>'
            + '</tr>'
            + '<tr class=hid>'
            + '<td width=66>下注号码：</td>'
            + '<td colspan=3>' + position + decodeURIComponent(betArr['code']).replace(/&/g, ',') + '</td>'
            + '</tr>'
            + '</table>'
            + '</div>';
    $.dialogBox(txtHtml, '注单详情', 580);
}
// 内页的所有开奖结果和走势图会用到如下方法
function getTobMenuHtml(type_flag)
{   if(!type_flag){type_flag="trend";}
    var wd_ = window;
    if( window != window.parent )
    {
        if( window.parent != window.parent.parent )
        {
            wd_ = window.parent.parent;
        }
        else
        {
            wd_ = window.parent;
        }
    }

    function i_inHtml(data)
    {
        var gameType = {
            "1":{name:"时时彩",htmlArr:[]},
            "2":{name:"快三",htmlArr:[]},
            "3":{name:"十一选5",htmlArr:[]},           
            "5":{name:"低频",htmlArr:[]},
            "6":{name:"PC蛋蛋",htmlArr:[]},
            "7":{name:"快乐十分",htmlArr:[]},
        };
        var innerHtml_draw = "",innerHtml_trend="";
        var arr_draw = [],arr_trend = [],arr_draw_list = [],arr_trend_list = [];
        arr_draw.push("<div data-type=\"all\" class=\"current\">全部彩种</div>");
        arr_trend.push("<div data-type=\"all\" class=\"current\">全部彩种</div>");
        for(var gtype in gameType)
        {
            arr_draw.push('<div data-type="'+gtype+'">'+gameType[gtype].name+'</div>');
            arr_trend.push('<div data-type="'+gtype+'">'+gameType[gtype].name+'</div>');
        }
        for( var i=0;i<data.length;i++ )
        {
            var gid = data[i].id;
            arr_draw_list.push("<span id=\"_m_t_"+gid+"\" name=\"type_"+data[i]["type"]+"\"  onclick=\"__openWin('lottery_hall','/draw/detail.html?id="+gid+"')\">"+data[i]["name"]+"</span>");
            arr_trend_list.push("<span id=\"_m_t_"+gid+"\" name=\"type_"+data[i]["type"]+"\" onclick=\"__openWin('lottery_hall','/trend/index.html?gameId="+gid+"')\">"+data[i]["name"]+"</span>");
        }
        innerHtml_draw = "<div class=\"tab_menu\">"+arr_draw.join("")+"</div><div class=\"game_btn\">"+arr_draw_list.join("")+"<i></i></div>";
        innerHtml_trend = "<div class=\"tab_menu\">"+arr_draw.join("")+"</div><div class=\"game_btn\">"+arr_trend_list.join("")+"<i></i></div>";

        wd_._top_menu_html={draw:innerHtml_draw,trend:innerHtml_trend};
        $("#_top_menu_div").html(wd_._top_menu_html[type_flag]);
    }
    function getUrlParameterResult(paramName,url){
        var returnVal = "";
        try {
            var paramUrl = url;
            if (paramUrl.length > 0){
                paramUrl = paramUrl.replace("/draw/detailNew.html?", "");
                var paramUrlArray = paramUrl.split("&");
                for (var i = 0; i < paramUrlArray.length; i++) {
                    if (paramUrlArray[i].toLowerCase().indexOf(paramName.toLowerCase()) != -1) {
                        var temp = paramUrlArray[i].split("=");
                        if (temp[0].toLowerCase() == paramName.toLowerCase()) {
                            returnVal = temp[1];
                            break;
                        }
                    }
                }
            }
        } catch (e) { }
        return returnVal;
    }
    //高亮 当前所在彩种
    function liang()
    {
        function getUrlParameter(paramName){
            var returnVal = "";
            try {
                var paramUrl = window.location.search;    //这里得到的是：?id=1&name=lxy&age=23
                //处理长度
                if (paramUrl.length > 0){
                    paramUrl = paramUrl.substring(1, paramUrl.length);    //这里得到的是：id=1&name=lxy&age=23
                    var paramUrlArray = paramUrl.split("&");
                    for (var i = 0; i < paramUrlArray.length; i++) {
                        if (paramUrlArray[i].toLowerCase().indexOf(paramName.toLowerCase()) != -1) {
                            var temp = paramUrlArray[i].split("=");   //'='的前面即temp[0]是参数名
                            if (temp[0].toLowerCase() == paramName.toLowerCase()) {
                                returnVal = temp[1];
                                break;
                            }
                        }
                    }
                }
            } catch (e) { }
            return returnVal;
        }
        var id = getUrlParameter("id")?getUrlParameter("id"):getUrlParameter("gameId");
        $("#_top_menu_div  #_m_t_"+id).addClass("current");
    }
    function i_ajax()
    {
        $.ajax({'url': '/trend/getGameType.html',
            'dataType': 'json',
            'type': 'get'
        }).done(function(data){
            i_inHtml(data);
            liang();
        });
    }
    try{
        if( wd_._top_menu_html)
        {
            $("#_top_menu_div").html(wd_._top_menu_html[type_flag]);
        }
        else
        {
            try{
                i_ajax();
            }catch(e){try{console.log(e);}catch(e){}}
        }
    }catch(e){
        i_ajax();
        try{console.log(e);}catch(e){}
    }
    try
    {
        liang();
    }
    catch(e){}
    try
    {
        $("#_top_menu_div").on("click",".tab_menu>div",function()
        {
            $("#_top_menu_div .game_btn>[onclick]").hide();
            $("#_top_menu_div .tab_menu>div").removeClass("current");
            $(this).addClass("current");
            if( $(this).data("type") == "all" )
            {
                $("#_top_menu_div .game_btn>[onclick]").show();
            }
            else
            {
                $("#_top_menu_div .game_btn>[name=type_"+$(this).data("type")+"]").show();
            }
        });
    }
    catch(e){}
}

// _common 是 命名空间
window._common = {};
_common.util = {
    //将一个json格式的object对象，转成json标准格式的字符串
    jsonToString:function( jsonObj ){
        var jStr = "{";
        for(var item in jsonObj ){
            jStr += "\""+item+"\":\""+jsonObj[item]+"\",";
        }
        jStr = jStr.substr(0,jStr.length-1);
        jStr += "}";
        return jStr;
    },
    Math_temp:function(a,b)
    {
        var length_a = 0,length_b= 0,length= 0;
        if( a.toString().indexOf("e")>=0 && a.toString().split("e")[1]!="" )
        {
            length_a += a.toString().split("e")[1]*(-1) ;
            a = a.toString().split("e")[0];
        }
        if( a.toString().indexOf(".") >= 0 )
        {
            length_a += a.toString().split(".")[1].length;
            a = a.toString().split(".")[0]+""+a.toString().split(".")[1];
        }
        if(b.toString().indexOf("e")>=0&&b.toString().split("e")[1]!="")
        {
            length_b += b.toString().split("e")[1]*(-1) ;
            b = b.toString().split("e")[0];
        }
        if( b.toString().indexOf(".") >= 0  )
        {
            length_b += b.toString().split(".")[1].length ;
            b = b.toString().split(".")[0]+""+b.toString().split(".")[1];
        }
        if( length_b > length_a )
        {
            a = parseInt(a)*Math.pow(10,length_b-length_a);
            b=parseInt(b);
            length = length_b;
        }
        else
        {
            b = parseInt(b)*Math.pow(10,length_a-length_b);
            a=parseInt(a);
            length = length_a;
        }
        return {a:a,b:b,length:length};
    },
    Math_result:function( result )
    {
        if( result.toString().indexOf("e")>=0 && result.toString().split("e")[1]!="" )
        {
            var length = result.toString().split("e")[1]*(-1) ;
            result = result.toString().split("e")[0];
            if( result.toString().indexOf(".") >= 0 )
            {
                length += result.toString().split(".")[1].length;
                result = result.toString().split(".")[0]+""+result.toString().split(".")[1];
            }
            if( 0 == length )
            {
                return result;
            }
            if( length < 0 )
            {
                length = length*(-1);
                var temp = "";
                while(length>0)
                {
                    temp += "0";
                    length--;
                }
                result = result+temp;
            }
            else
            {
                if( result.length > length )
                {
                    result = result.substr(0,result.length-length)+"."+result.substr(result.length-length,length);
                }
                else
                {
                    var temp = "";
                    while(length>result.length)
                    {
                        temp += "0";
                        length--;
                    }
                    result = "0."+temp+result;
                }
            }
        }
        return result;
    },
    /**
     * 用于计算两个数的加法（包括带小数的浮点）
     * @demo  _common.util.Math_add(0.1515,0.0000003)
     * @return // 0.1515+0.0000003 =  0.1515003
     */
    Math_add : function (a, b)
    {
        var o = _common.util.Math_temp(a,b);
        var result = (o.a+o.b)/Math.pow(10, o.length);
        return _common.util.Math_result(result);
    },
    /**
     * 用于计算两个数的减法（包括带小数的浮点）
     * @demo  _common.util.Math_sub(0.1515,0.0000003)
     * @return // 0.1515 - 0.0000003
     */
    Math_sub : function (a, b)
    {
        var o = _common.util.Math_temp(a,b);
        var result = ( o.a - o.b )/Math.pow( 10, o.length );
        return _common.util.Math_result(result);
    },
    /**
     * 用于计算两个数的乘法（包括带小数的浮点）
     * @demo  _common.util.Math_mul(0.1515,0.0000003)
     * @return // 0.1515 * 0.0000003
     */
    Math_mul : function (a, b)
    {
        var o = _common.util.Math_temp(a,b);
        var result = (o.a* o.b)/Math.pow(10, o.length*2);
        return _common.util.Math_result(result);
    },
    /**
     * 用于计算两个数的除法（包括带小数的浮点）
     * @demo  _common.util.Math_div(0.1515,0.0000003)
     * @return //   0.1515/0.0000003 =  505
     */
    Math_div : function (a, b)
    {
        var o = _common.util.Math_temp(a,b);
        var result = (o.a/ o.b);
        return _common.util.Math_result(result);
    },
    dialogUi:function(){
        if( !$("#JS_blockPage").get(0) )
        {
            var newDiv = $("<div id=\"JS_blockPage\" class=\"JS_blockPage\"><div class=\"detail_dialog\"><h3 id=\"block_draghandler\"></h3><img src=\""+_prefixURL.statics+"/images/close.gif\" class=\"c1\" id=\"block_close\"><div class=\"table\"></div></div></div>");
            $("body").append(newDiv);
            $("#block_close").click(function(){
                $("#JS_blockPage").css( "display","none" );
            });
        }
    }
};
