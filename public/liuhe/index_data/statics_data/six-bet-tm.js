
    var sxObj = (function() {
        var TM = {
            init: function() {
                this.odds_tm_temp = $('#tmOdds-template');
                this.odds_number_temp = $('#numberOdds-template');
                this.container_number = $('#body-number-template');
                this.container_number_b = $('#body-number-template-b');
                this.container_tm = $('#body-template');
                this.container_tmb = $('#body-template-b');

            },
            bindEvent: function() {
                var self = this;
                $('.tab_title02', '#bet_panel').find('a').on('click', function(e) {
                    try{if(e.preventDefault){e.preventDefault();}else{e.returnValue = false;}}catch(e){}
                    var data = $(this).data('type');
                    if (!$(this).hasClass('on')) {
                        $(this).addClass('on').siblings('a').removeClass('on');
                    }
                    switch (data) {
                        case "a":
                            self.render(self.dataArray);
                            reset();
                            break;
                        case "b":
                            self.render(self.dataArrayB);
                            reset();
                            break;
                    }

                });
            },
            fetchTMA: function() {
                return $.ajax({
                    type: 'GET',
                    url: '/sixGame/getPrizeData.html',
                    dataType: 'json',
                    data: { name: '特码A'}
                }).promise();
            },
            fetchTMB: function() {
                return $.ajax({
                    type: 'GET',
                    url: '/sixGame/getPrizeData.html',
                    dataType: 'json',
                    data: { name: '特码B'}
                }).promise();
            },
            fetchSXNumber: function() {
                return $.ajax({
                    type: 'GET',
                    url: '/sixGame/getNumbers.html',
                    dataType: 'json'
                }).promise();
            },
            render: function(datas) {
                var _self = this,
                    numbersource = this.odds_number_temp.html() || "",
                    tmsource = this.odds_tm_temp.html(),
                    dataJSON = datas,
                    dataNewArray = [],
                    dataTMArray = [],
                    out = "",
                    tm = "";
                //处理数据分组(1 11 21 31 41)(2 12 22 32 42).....
                for (var i = 0; i < 10; i++) {
                    var row = [],
                        j = i;
                    for (j; j < 49; j = j + 10) {
                        row.push(dataJSON[j]);
                    }
                    dataNewArray.push(row);
                }
                $.each(dataNewArray, function(i, value) {
                    out = out + '{ "row" :' + JSON.stringify(value) + '},';
                });
                out = out.substr(0, out.lastIndexOf(','));
                //处理 特大，特小。。。。。
                var dataSpecial = dataJSON.slice(49, dataJSON.length);
                var y = (dataSpecial.length) % 4 == 0 ? (dataSpecial.length) / 4 : Math.floor((dataSpecial.length) / 4 + 1);
                for (var j = 0; j < y; j++) {
                    var row = [],
                        m = j;
                    for (m; m < dataSpecial.length; m = m + y) {
                        row.push(dataSpecial[m]);
                    }
                    dataTMArray.push(row);
                }
                $.each(dataTMArray, function(index, value) {
                    tm = tm + '{ "row" :' + JSON.stringify(value) + '},'; //JSON.stringify methods change to json string
                });
                tm = tm.substr(0, tm.lastIndexOf(','));
                var data = JSON.parse("[" + out + "]"),
                    tmdata = JSON.parse("[" + tm + "]");
                Handlebars.registerHelper('odd', function(value1, value2, value3) {
                    //value==prizeMax,value2===prizeMin,value3===maxPoint
                    var point = $('#point').val();
                    var value = Number(value2) + Number(point) * 100 * (Number(value1) - Number(value2)) / (Number(value3) * 100);
                    return new Handlebars.SafeString(value.toFixed(3));
                });
                Handlebars.registerHelper('both', function(value) {
                    var v = Number(value);
                    var results = (v < 10 ? ("0" + v) : v);
                    return new Handlebars.SafeString(results);
                });

                var newnumlist = new Array();

                $.each(getnumlist, function(i, value) {
                    newnumlist.push(parseInt(value));
                });

                if(!isNaN(parseFloat(getnumamount[1])) && isFinite(getnumamount[1])){
                    $('.quickmoney').val(getnumamount[1]);

                }
               // if(Number.isInteger(parseInt(getnumamount[1]))){
                    // $('.quickmoney').val(getnumamount[1]);
                //}

                Handlebars.registerHelper('numvalue', function(value) {
                    var v = parseInt(Number(value));
                    var results = parseInt((v < 10 ? ("0" + v) : v));
                    if(newnumlist.indexOf(results)> -1){
                        v = parseInt(getnumamount[1]);
                        return new Handlebars.SafeString(v);
                    }else {
                        v = '';
                        return new Handlebars.SafeString(v);
                    }
                });

                Handlebars.registerHelper('numselected', function(value) {
                    var v = parseInt(Number(value));
                    var results = parseInt((v < 10 ? ("0" + v) : v));
                    if(newnumlist.indexOf(results)> -1){
                        v = 'inputSelected';
                    }else {
                        v = v;
                    }
                    return new Handlebars.SafeString(v);
                });
                Handlebars.registerHelper('numlist', function(value) {
                    var v = parseInt(Number(value));
                    var results = parseInt((v < 10 ? ("0" + v) : v));
                    if(newnumlist.indexOf(results)> -1){
                        v = 'GTMselected';
                    }else {
                        v = v;
                    }
                    return new Handlebars.SafeString(v);
                });

                //handlebars compiles and data bind
                var temple_number = Handlebars.compile(numbersource);
                var temple_tm = Handlebars.compile(tmsource);
                this.container_number.html(temple_number(data));
                this.container_tm.html(temple_tm(tmdata));
                selectBet.init();
            }
        };
        if ($('#lottory_open', window.parent.document).val() === 'false') {
            selectBet.init();
            TM.bindEvent();
            return;
        }
        TM.init();
        var sxobj = {};
        $.when(TM.fetchTMA(), TM.fetchTMB(), TM.fetchSXNumber()).then(function(result1, result2, result3) {
            TM.dataArray = result1[0].data["特码"];
            TM.dataArrayB = result2[0].data["特码"];
            for(var prop in TM.dataArray){
                TM.dataArray[prop].tab = 'a';
            }
            for(var prop in TM.dataArrayB){
                TM.dataArrayB[prop].tab = 'b';
            }
            TM.render(TM.dataArrayB);
            TM.bindEvent();
            sxobj.shu = result3[0]['鼠'];
            sxobj.yang = result3[0]['羊'];
            sxobj.tu = result3[0]['兔'];
            sxobj.hou = result3[0]['猴'];
            sxobj.ma = result3[0]['马'];
            sxobj.she = result3[0]['蛇'];
            sxobj.long = result3[0]['龙'];
            sxobj.hu = result3[0]['虎'];
            sxobj.niu = result3[0]['牛'];
            sxobj.zhu = result3[0]['猪'];
            sxobj.gou = result3[0]['狗'];
            sxobj.ji = result3[0]['鸡'];

        });
        return sxobj;
    })();
