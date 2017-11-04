
var qs = document.referrer.split('?')[1] || '';
var res = qs.split("&");
var getnumlist = [];
var getnumamount ='';
$.each( res, function( key, value ) {
    if(key == 0){ getnumamount = value.split("="); }
      if(key != 0 && key != 6 && key != 7) {
          $.each(value.split("="), function (key, value) {
              if ($.isNumeric(value)) {
                  getnumlist.push(value);
              }
          });
      }
});

$.fn.removeClassRegex = function(regex) {
    return this.removeClass(function(index, classes) {
        return classes.split(/\s+/).filter(function(c) {
            return regex.test(c);
        }).join(' ');
    });
};
$.fn.hasClassRegex = function(regex) {
    var has = false;
    this.each(function() {
        var classes = $(this).attr('class');
        if (classes == null) {
            return;
        }
        $.each(classes.split(/\s+/), function() {
            if (regex.test(this)) {
                has = true;
                return false;
            }
        });
        if (has) {
            return false;
        }
    });
    return has;
};
$.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(),
        validLabels = /^(data|css):/,
        attr = {
            method: matchParams[0].match(validLabels) ?
                matchParams[0].split(':')[0] : 'attr',
            property: matchParams.shift().replace(validLabels, '')
        },
        regexFlags = 'ig',
        regex = new RegExp(matchParams.join('').replace(/^s+|s+$/g, ''), regexFlags);
    return regex.test(jQuery(elem)[attr.method](attr.property));
};

var selectBet = {
    quickmoney: '',
    init: function() {
        this.$thtd = $('.GTM');
        open_or_not = $('#lottory_open', window.parent.document).val();
        this.select();
        this.inputMethod();
    },
    select: function() {
        this.$thtd.on('click', function(e) {
            var _self = $(this);
            //后台未开盘
            if (open_or_not === 'false') {
                pop('myModal', 2);
                return;
            }
            var current = $(this).data('current'),
                money = $('.quickmoney').eq(0).val(),
                $input = _self.siblings('.GTM' + current).find('input').length === 0 ? _self.find('input') : _self.siblings('.GTM' + current).find('input');
            if (_self.hasClassRegex(/([a-z]+-[a-zA-Z0-9]+-?select)/)) {
                if (_self.hasClass('GTMselected')) {
                    _self.removeClass('GTMselected').siblings('.GTM' + current).removeClass('GTMselected').find('input').removeClassRegex(/inputSelected|([a-z]+-[a-zA-Z0-9]+-?inputSelected)/);
                }
                _self.removeClassRegex(/([a-z]+-[a-zA-Z0-9]+-?select)/).siblings('.GTM' + current).removeClassRegex(/([a-z]+-[a-zA-Z0-9]+-?select)/).find('input').removeClassRegex(/inputSelected|([a-z]+-[a-zA-Z0-9]+-?inputSelected)/);
                if (!_self.hasClass('GTMselected')) {
                    $input.val('');
                }
            } else {
                _self.toggleClass('GTMselected').siblings('.GTM' + current).toggleClass('GTMselected').find('input').toggleClass('inputSelected');
                // _self.toggleClass('GTMselected').parent().toggleClass('GTMselected');;
                _self.find('input').toggleClass('inputSelected');
                if (!_self.hasClass('GTMselected')) {
                    $input.val('');
                }
            }
            if (_self.hasClass('GTMselected')) {
                _self.find('input').focus();
                _self.siblings('.GTM' + current).find('input').focus();
            }
            if (_self.find('input').is(':focus')) {
                _self.addClass('GTMselected').find('input').addClass('inputSelected').parent().prev('td').addClass('GTMselected').prev('th').addClass('GTMselected');
                _self.addClass('GTMselected').find('input').addClass('inputSelected').parent().prev('td').addClass('GTMselected').prev('td').addClass('GTMselected').prev('th').addClass('GTMselected');
                _self.addClass('GTMselected').prev().addClass('GTMselected');
            }
            if (money === '') {
                var selectedNum = Number($('input[class$="inputSelected"]').size()); //判断选了几注
            } else {
                var selectedNum = Number($('input[class$="inputSelected"]').size()); //判断选了几注
            }
            //判断金额输入框input中是否有值并且下面的input是否有选中既hasclass 'GTMselected' 就是选择的input中自动填入金额
            if (money != '' && $(this).hasClass('GTMselected')) {
                //$(this) == th和td $(this).siblings('.GTM'+current).find('input')==td下有input的
                $input.val(money);
            }
            if (selectedNum === 0) {
                $('#showbetsnumber').hide();
            } else {
                $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
            }

        });
    },
    inputMethod: function() {
        //后台未开盘
        if (open_or_not === 'false') {
            $('.quickmoney').prop('disabled', true);
            return;
        }
        var _self = this;
        $('.quickmoney').keyup(function(event) {
            /* Act on the event */
            var _slef = $(this),
                value = Math.abs($(this).val()) === 0 ? '' : Math.abs($(this).val()),
                inputselect = $('input[class$="inputSelected"]'),
                quicks = $('.quickmoney');
            $.each(quicks, function(index, el) { //设置金额输入的时候同步显示（上面和下面的金额输入框）
                $(el).val(value);
            });
            if (value === '') {
                $.each(inputselect, function(index, el) {
                    $(el).val('');
                });
                _self.quickmoney = '';
            } else {
                $.each(inputselect, function(index, el) {
                    $(el).val(value);
                });
                _self.quickmoney = value;
            }
        });
    },
    fetchLM: function() {
        return $.ajax({
            url: '/sixGame/RankingCnt.html',
            type: 'GET',
            dataType: 'json'
        }).promise();
    },
    render: function(data) {
        var source = $('#lmchanglong-template').html();
        Handlebars.registerHelper('parse', function(value) {
            var v;
            switch (value) {
                case '两面':
                    v = 'lm';
                    break;
                case '总肖':
                    v = 'zxs';
                    break;
                case '正码1-6':
                    v = 'zm16';
                    break;
            }
            return new Handlebars.SafeString(v);
        });

        template = Handlebars.compile(source);
        $('#lm-changlong-template').html(template(data));
        var paramstr = window.location.search;
        paramstr = paramstr.replace("?disthtml=", "");
        var getalllist = $('#bclass >a', window.parent.document);

        var dataList = getalllist.map(function(){
            if($(this).data("href")==paramstr) {
                return $(this).addClass("active");
            }else{
                $(this).removeClass("active");
            }
        }).get();
    }
}
$.when(selectBet.fetchLM()).then(function(data) {
    selectBet.render(data.data);
});

function bet() {
    var open_or_not = $('#lottory_open', window.parent.document).val();
    if (open_or_not === 'false') {
        pop('myModal', 2);
        return;
    }
    if( $('#'+window.parent.balance_span, window.parent.document).length == 0 )
    {
        var balance = $('#'+parent.balance_span, parent.parent.document).text();
    }
    else
    {
        var balance = $('#'+parent.balance_span, parent.document).text();
    }
    if (balance === null || balance === '' || balance === undefined || balance === '￥') {
        pop('myModal', 5);
        return;
    }
    var inputArray = [],
        $input = $('input[class$="inputSelected"]'),
        selected = $input.size();
    if (selected == 0) {
        pop('myModal', 3);
        return;
    }
    $input.each(function(index, el) {
        if ($(el).val() != '') {
            inputArray.push($(el));
        }
    });
    if (inputArray.length === 0) {
        pop('myModal', 0);
        return;
    }
    var dataArray = [],
        count = 0,
        total = 0;
    $.each(inputArray, function(index, el) {
        var methodid = Number($(el).attr('subId')),
            type = $(el).attr('type'),
            money = $(el).val(),
            codes = $(el).attr('codes'),
            name = $(el).attr('name'),
            odds = $(el).attr('odds');
        tab = $(el).attr('tab');
        if (tab) {
            str = ' {"name":"' + name + '","odds":"' + odds + '","value":"' + money + '","methodid":" ' + methodid + ' ","type":" ' + type + '","money":"' + money + '","tab":"' + tab + '","codes":"' + codes + '"}';
        } else {
            str = ' {"name":"' + name + '","odds":"' + odds + '","value":"' + money + '","methodid":" ' + methodid + ' ","type":" ' + type + '","money":"' + money + '","codes":"' + codes + '"}';
        }
        total = total + Number(money);
        ++count;
        dataArray.push(JSON.parse(str));
    });
    var source = $("#betlist-template", window.parent.document).html();
    var template = Handlebars.compile(source);
    $('#six_betList', window.parent.document).html(template(dataArray));
    $('#bcount', window.parent.document).text("组数：" + count);
    $('#btotal', window.parent.document).text("总金额：" + total);
    $('#totalhidden', window.parent.document).val(total);
    reset();
    selectBet.quickmoney = '';
    pop('betModal', 1);
}

//重置功能
function reset() {
    $('.quickmoney').val('');
    $('.GTM').removeClass('GTMselected').removeClassRegex(/[a-z]+-[a-zA-Z0-9]+-?select/).removeClass('flx');
    $('#quick_sec_table').find('tbody').find('tr td').removeClass('active');
    $('.GTM input').val('');
    $('input[class$="inputSelected"]').removeClassRegex(/inputSelected|[a-z]+-[a-zA-Z0-9]+-?inputSelected/);
    $('#showbetsnumber').hide().find('span').text(''); //底部显示选择了几注
}
//弹框功能
function pop(id, type) {
    var modal = parent.document.getElementById(id),
        span = parent.document.getElementsByClassName("close")[0],
        btnclose = parent.document.getElementById("closebtn") ? parent.document.getElementById("closebtn") :$(modal).find("button").get(0),
        span1 = parent.document.getElementsByClassName("close")[1],
        confirmbtn = parent.document.getElementById('confirmbtn');
    modal.style.display = "block";
    span.onclick = function() {
        modal.style.display = "none";
    };
    span1.onclick = function() {
        // reset();
        modal.style.display = "none";
    };
    try{
        btnclose.onclick = function() {
            modal.style.display = "none";
        };
    }catch(e){ console.log(e); }

    confirmbtn.onclick = function() {
        parent.confirmBet();
    };
    if (type === 0) {
        //您输入类型不正确或没有输入实际金额
        parent.document.getElementById('content').innerHTML = '您输入类型不正确或没有输入实际金额！';
    } else if (type === 2) {
        parent.document.getElementById('content').innerHTML = '对不起！后台未开盘，不能下注！';
    } else if (type === 3) {
        parent.document.getElementById('content').innerHTML = '请选择号码下注！！';
    } else if (type === 4) {
        parent.document.getElementById('content').innerHTML = '金额不能超过5000元！！';
    } else if (type === 5) {
        $('#username',window.parent.document).focus();
        reset();
        parent.document.getElementById('content').innerHTML = '对不起,您未登录或已自动退出！';
    }

}
//投注提交功能绑定
$('.commitbtn').on('click', function() {
    bet();
});
$('.resetbtn').on('click', function() {
    reset();
});
//快捷投注
$('#bntquick').on('click', function() {
    if ($(this).val() == '快捷投注') {
        $(this).val('两面长龙');
    } else {
        $(this).val('快捷投注');
    }
    $('#quick_sec_table').toggleClass('hidden');
    $('#changlong').toggleClass('hidden');
});
//判断是否开盘$('#lottory_open', window.parent.document).val() === 'false'为未开盘
(function() {
    if ($('#lottory_open', window.parent.document).val() === 'false') {
        $('table#quick_sec_table').find('tbody').find('tr td[data*="sple-"]').on('click', function() {
            pop('myModal', 2);
        });
          $('table#quick_sec_table').find('tbody').find('tr td[data*="an-"]').on('click', function() {
            pop('myModal', 2);
        });
         $('table#quick_sec_table').find('tbody').find('tr td[data*="col-"]').on('click', function() {
            pop('myModal', 2);
        });
        $('#changlong').on('click', 'a', function(e) {
            try{if(e.preventDefault){e.preventDefault();}else{e.returnValue = false;}}catch(e){}
            pop('myModal', 2);
        });
        return;
    }
    //单码
    $('#quick_sec_table').find('tbody').find('tr td[data="sple-danM-"]').on('click', function() {
       
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();

        $el.toggleClass('active');
        var $arr = $('#body-number-template').find('tr:nth-child(odd)').find('th');
        if ($el.hasClass('active')) {
            $arr.each(function(index, el) {
                $(el).addClass(dataClass + "select").next('td').addClass(dataClass + "select").next('td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
            });
        } else {
            $arr.each(function(index, el) {
                $(el).removeClass(dataClass + "select").next('td').removeClass(dataClass + "select").next('td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }
    });
    //小单
    $('#quick_sec_table').find('tbody').find('tr td[data="sple-xdan-"]').on('click', function() {
        //tr:nth-child(odd) is faster than tr:even
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var inputs = $('#body-number-template').find('tr:nth-child(odd)').find('td').find('input');
        if ($el.hasClass('active')) {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content <= 24) {
                    $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                }
            });
        } else {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content <= 24) {
                    $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }

    });
    //小双
    $('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-xshuang-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var inputs = $('#body-number-template').find('tr:nth-child(even)').find('th,td').find('input');
        if ($el.hasClass('active')) {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content <= 24) {
                    $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                }
            });
        } else {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content <= 24) {
                    $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }

    });
    //大单
    //$('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-ddan-"]') is faster than $('#quick_sec_table tbody tr td[data="sple-ddan-"]') 
    $('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-ddan-"]').on('click', function() {
        var inputs = $('#body-number-template').find('tr:nth-child(odd)').find('th,td').find('input');
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        if ($el.hasClass('active')) {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 25) {
                    $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                }
            });
        } else {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 25) {
                    $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }
    });
    //大双
    $('#quick_sec_table tbody tr td[data="sple-dshuang-"]').on('click', function() {
        var inputs = $('#body-number-template').find('tr:nth-child(even)').find('th,td').find('input');
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        if ($el.hasClass('active')) {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 25) {
                    $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                }
            });
        } else {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 25) {
                    $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }

    });
    //双码
    $('#quick_sec_table tbody tr td[data="sple-shuangM-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        if ($el.hasClass('active')) {
            $('#body-number-template').find('tr:nth-child(even)').find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
        } else {
            $('#body-number-template').find('tr:nth-child(even)').find('th,td').removeClass(dataClass + "select").removeClass(dataClass + 'inputSelected').val('');
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }
    });
    //大码
    $('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-daM-"]').on('click', function() {
        var bigArray = $('#body-number-template').find('tr').find('td').find('input');
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        if ($el.hasClass('active')) {
            bigArray.each(function(index, el) {
                if (Number($(el).attr('codes')) >= 25) {
                    $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                }
            });
        } else {
            bigArray.each(function(index, el) {
                if (Number($(el).attr('codes')) >= 25) {
                    $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }

    });
    //小码
    $('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-xiaoM-"]').on('click', function() {
        var smallArray = $('#body-number-template').find('tr').find('td').find('input');
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        if ($el.hasClass('active')) {
            smallArray.each(function(index, el) {
                if (Number($(el).attr('codes')) <= 24) {
                    $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                }
            });
        } else {
            smallArray.each(function(index, el) {
                if (Number($(el).attr('codes')) <= 24) {
                    $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }

    });
    //合单
    $('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-hdan-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var inputs = $('#body-number-template').find('tr').find('td').find('input');
        if ($el.hasClass('active')) {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 10) {
                    var single = (content + '').substr(0, 1),
                        double = (content + '').substr(1, 2),
                        total = Number(single) + Number(double);
                    if (total % 2 != 0) {
                        $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                    }

                } else {
                    if (content % 2 != 0) {
                        $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                    }
                }
            });
        } else {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 10) {
                    var single = (content + '').substr(0, 1),
                        double = (content + '').substr(1, 2),
                        total = Number(single) + Number(double);
                    if (total % 2 != 0) {
                        $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                    }

                } else {
                    if (content % 2 != 0) {
                        $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                    }
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }

    });
    //合双
    $('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-hshuang-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var inputs = $('#body-number-template').find('tr').find('td').find('input');
        if ($el.hasClass('active')) {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 10) {
                    var single = (content + '').substr(0, 1),
                        double = (content + '').substr(1, 2),
                        total = Number(single) + Number(double);
                    if (total % 2 == 0) {
                        $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                    }

                } else {
                    if (content % 2 == 0) {
                        $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                    }
                }
            });
        } else {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 10) {
                    var single = (content + '').substr(0, 1),
                        double = (content + '').substr(1, 2),
                        total = Number(single) + Number(double);
                    if (total % 2 == 0) {
                        $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                    }

                } else {
                    if (content % 2 == 0) {
                        $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                    }
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }

    });
    //合大
    $('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-hda-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var inputs = $('#body-number-template').find('tr').find('td').find('input');
        if ($el.hasClass('active')) {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content > 10) {
                    var single = (content + '').substr(0, 1),
                        double = (content + '').substr(1, 2),
                        total = Number(single) + Number(double);
                    if (total >= 7) {
                        $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                    }

                } else if (content >= 7 && content < 10) {
                    $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                }
            });
        } else {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content > 10) {
                    var single = (content + '').substr(0, 1),
                        double = (content + '').substr(1, 2),
                        total = Number(single) + Number(double);
                    if (total >= 7) {
                        $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                    }

                } else if (content >= 7 && content <= 10) {
                    $(el).removeClass(dataClass + 'inputSelected').val(money).parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }


    });
    //合小
    $('#quick_sec_table').find('tbody').find('tr').find('td[data="sple-hxiao-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var inputs = $('#body-number-template').find('tr').find('td').find('input');
        if ($el.hasClass('active')) {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 10) {
                    var single = (content + '').substr(0, 1),
                        double = (content + '').substr(1, 2),
                        total = Number(single) + Number(double);
                    if (total <= 6) {
                        $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                    }
                } else if (content <= 6) {
                    $(el).addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev().addClass(dataClass + "select").prev().addClass(dataClass + "select");
                }
            });
        } else {
            inputs.each(function(index, el) {
                var content = Number($(el).attr('codes'));
                if (content >= 10) {
                    var single = (content + '').substr(0, 1),
                        double = (content + '').substr(1, 2),
                        total = Number(single) + Number(double);
                    if (total <= 6) {
                        $(el).removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                    }
                } else if (content <= 6) {
                    $(el).removeClass(dataClass + 'inputSelected').val(money).parent().removeClass(dataClass + "select").prev().removeClass(dataClass + "select").prev().removeClass(dataClass + "select");
                }
            });
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }


    });

    //0 1 2 3 4 头 
    $('#quick_sec_table').find('tbody').find('tr').find('td[data*="tou"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var v = $(this).text().substr(0, 1),
            arr,
            $td = $('#body-number-template').find('tr').find('td');
        switch (v) {
            case '0':
                arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }
                }
                break;
            case '1':
                arr = [10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }
                }
                break;
            case '2':
                arr = [20, 21, 22, 23, 24, 25, 26, 27, 28, 29];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }
                }
                break;
            case '3':
                arr = [30, 31, 32, 33, 34, 35, 36, 37, 38, 39];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }
                }
                break;
            case '4':
                arr = [40, 41, 42, 43, 44, 45, 46, 47, 48, 49];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val(money).parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }
                }
                break;

        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }
    });
    //1~~~~~~~~~~~~~~~9 尾 data*="wei"---> All elements with a title attribute value containing the word "wei"
    $('#quick_sec_table').find('tbody').find('tr').find('td[data*="wei"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var v = $(this).text().substr(0, 1);
        switch (v) {
            case '0':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(9).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(9).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }

                break;
            case '1':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(0).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(0).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
            case '2':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(1).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(1).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
            case '3':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(2).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(2).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
            case '4':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(3).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(3).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
            case '5':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(4).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(4).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
            case '6':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(5).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(5).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
            case '7':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(6).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(6).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
            case '8':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(7).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(7).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
            case '9':
                if ($el.hasClass('active')) {
                    $('#body-number-template').find('tr').eq(8).find('th,td').addClass(dataClass + "select").find('input').addClass(dataClass + 'inputSelected').val(money);
                } else {
                    $('#body-number-template').find('tr').eq(8).find('th,td').removeClass(dataClass + "select").find('input').removeClass(dataClass + 'inputSelected').val('');
                }
                break;
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }
    });
    /*----------  十二生肖选择  ----------*/
    $('#quick_sec_table').find('tbody').find('tr').find('td[data^="an-"]').on('click', function(event) {
        try{if(event.preventDefault){event.preventDefault();}else{event.returnValue = false;}}catch(e){}
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val(),
            tag = $el.text(),
            $td = $('#body-number-template').find('tr').find('td');
        $el.toggleClass('active');
        switch (tag) {
            case '鼠':
                var arr = sxObj.shu;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '龙':
                var arr = sxObj.long;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '猴':
                var arr = sxObj.hou;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '牛':
                var arr = sxObj.niu;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '蛇':
                var arr = sxObj.she;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '鸡':
                var arr = sxObj.ji;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '虎':
                var arr = sxObj.hu;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '马':
                var arr = sxObj.ma;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '狗':
                var arr = sxObj.gou;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '兔':
                var arr = sxObj.tu;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '羊':
                var arr = sxObj.yang;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
            case '猪':
                var arr = sxObj.zhu;
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }

                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }

                }
                break;
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }
    });

    //红蓝色波  $("[title^='Tom']") All elements with a title attribute value starting with "Tom"
    $('#quick_sec_table').find('tbody').find('tr').find('td[data^="col-red"],td[data^="col-blue"],td[data^="col-green"]').on('click', function(event) {
        try{if(event.preventDefault){event.preventDefault();}else{event.returnValue = false;}}catch(e){}
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var tag = $(this).text(),
            arr,
            $td = $('#body-number-template').find('tr').find('td');
        switch (tag) {
            case '红':
                arr = [1, 2, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }
                }

                break;
            case '红单':
                arr = [1, 7, 13, 19, 23, 29, 35, 45];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '红双':
                arr = [2, 8, 12, 18, 24, 30, 34, 40, 46];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '红大':
                arr = [29, 30, 34, 35, 40, 45, 46];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '红小':
                arr = [1, 2, 7, 8, 12, 13, 18, 19, 23, 24];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '蓝':
                arr = [3, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }
                }
                break;
            case '蓝单':
                arr = [3, 9, 15, 25, 31, 37, 41, 47];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '蓝双':
                arr = [4, 10, 14, 20, 26, 36, 42, 48];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '蓝大':
                arr = [25,26, 31, 36, 37, 41, 42, 47, 48];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '蓝小':
                arr = [3, 4, 9, 10, 14, 15, 20];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '绿':
                arr = [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "select").prev('td').addClass(dataClass + "select").prev('th').addClass(dataClass + "select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "select").prev('td').removeClass(dataClass + "select").prev('th').removeClass(dataClass + "select");
                    }
                }
                break;
            case '绿单':
                arr = [5, 11, 17, 21, 27, 33, 39, 43, 49];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '绿双':
                arr = [6, 16, 22, 28, 32, 38, 44];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '绿大':
                arr = [27, 28, 32, 33, 38, 39, 43, 44, 49];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
            case '绿小':
                arr = [5, 6, 11, 16, 17, 21, 22];
                if ($el.hasClass('active')) {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').addClass(dataClass + 'inputSelected').val(money).parent().addClass(dataClass + "-select").prev('td').addClass(dataClass + "-select").prev('th').addClass(dataClass + "-select");
                    }
                } else {
                    for (var prop in arr) {
                        $td.find('input[codes ="' + arr[prop] + '"]').removeClass(dataClass + 'inputSelected').val('').parent().removeClass(dataClass + "-select").prev('td').removeClass(dataClass + "-select").prev('th').removeClass(dataClass + "-select");
                    }
                }
                break;
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }

    });

    //全选 
    $('#quick_sec_table').find('tbody').find('tr').find('td[data*="sple-all-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        var $thtd = $('#body-number-template').find('tr').find('th,td');
        if ($el.hasClass('active')) {
            $('#quick_sec_table').find('tbody').find('tr').find('td.active').removeClass('active');
            $el.addClass('active');
            $thtd.removeClassRegex(/flx|([a-z]+-[a-zA-Z0-9]+-?select)/).removeClass('GTMselected').addClass(dataClass + "select");
            // $thtd.not('.GTMselected').find('input').addClass('inputSelected');
            $thtd.find('input').addClass('inputSelected');
        } else {
            $thtd.removeClass(dataClass + "select");
            $thtd.find('input').removeClassRegex(/inputSelected|([a-z]+-[a-zA-Z0-9]+-?inputSelected)/);
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
        if (selectedNum === 0) {
            $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }
          $el.toggleClass('active');
    });
    //取消
    $('#quick_sec_table').find('tbody').find('tr').find('td[data*="sple-clear-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        $('#body-number-template').find('tr').find('th,td').removeClassRegex(/flx|([a-z]+-[a-zA-Z0-9]+-?select)/).removeClass('GTMselected').find('input').removeClassRegex(/inputSelected|([a-z]+-[a-zA-Z0-9]+-?inputSelected)/);
        $('#body-number-template td input').val("");
        $('#quick_sec_table').find('tbody').find('tr').find('td.active').removeClass('active');
        $('#showbetsnumber').hide();
    });
    //反选
    $('#quick_sec_table').find('tbody').find('tr').find('td[data*="sple-fx-"]').on('click', function() {
        var $el = $(this),
            dataClass = $el.attr('data'),
            money = $('.quickmoney').eq(0).val();
        $el.toggleClass('active');
        $thtd1 = $('#body-number-template').find('tr').find('th.GTMselected,td.GTMselected,th[class$="-select"],td[class$="-select"]');
        $thtd2 = $('#body-number-template').find('tr').find('th,td').not('.GTMselected,[class$="-select"]');
        if ($el.hasClass('active')) {
            $thtd1.addClass('clear-plain-select').find('input').removeClassRegex(/inputSelected|([a-z]+-[a-zA-Z0-9]+-?inputSelected)/);
            $thtd2.addClass('flx').find('input').addClass('inputSelected');
        } else {
            $thtd1.removeClass('clear-plain-select').removeClass('flx').find('input').addClass('inputSelected');
            $thtd2.removeClass('flx').find('input').removeClassRegex(/inputSelected|([a-z]+-[a-zA-Z0-9]+-?inputSelected)/);
        }
        var selectedNum = Number($('input[class$="inputSelected"]').val(money).size()); //判断选了几注
       if (selectedNum === 0) {
           $('#showbetsnumber').hide();
        } else {
            $('#showbetsnumber').show().find('span').text(selectedNum); //底部显示选择了几注
        }
        $el.toggleClass('active');
        $('#quick_sec_table').find('td').removeClass('active');
        
    });
    /*----------------------------------------------------------------------------------------------**/
    //两面长龙
    $('#changlong').on('click', 'a', function(e) {
        try{if(e.preventDefault){e.preventDefault();}else{e.returnValue = false;}}catch(e){}
        $el = $(e.target);
        var tag = $el.attr('href').split('#')[1],
            frame = $('#main .frame', window.parent.document),
            href1 = $el.attr('href').split('#')[0].split('page=')[1],
            href = $el.attr('href').split('#')[0].split('page=')[1] + '#' + tag,
            iframe = $('#frame', window.parent.document),
            _parent = window.parent,
            mainUrl = _parent.location.protocol + '//' + _parent.location.hostname + '/sixGame/statics.html?disthtml=';
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $('#bclass a[href="' + href1 + '"]', window.parent.document).addClass('active').siblings('a').removeClass('active');
        switch (href1) {
            case "zm16":
                frame.css({ 'height': 765 + 'px' });
                break;
            case "zxs":
                frame.css({ 'height': 565 + 'px' });
                break;
            case "lm":
                frame.css({ 'height': 515 + 'px' });
                break;
        }
        iframe.attr('src', mainUrl + href);
        return false;
    });
})();