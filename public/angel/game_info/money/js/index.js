var chart;
var labelsLength = 0;

function _init() {

    $('#dvStandard').html('<span>'+ money_standard + money_unit + '당 ' + Number(money_avg).currency() + '원</span><br><span>(' + money_date + ' 기준)</span>');
    _form.protect.number($('#txtMoney'));

    var gamelist = $('#gamelist');
    var length = gameName.length;
    var option = null;
    var bslt = false;
    for (var i = 0; i < length; i++) {
        option = document.createElement('OPTION');
        option.value = gameCode[i];
        option.appendChild(document.createTextNode(gameName[i]));
        if (g_game_code == gameCode[i]) {
            bslt = true;
            g_game_code_name = gameName[i];
            option.setAttribute('selected', 'selected');
        }
        gamelist.append(option);
    }
    if (!bslt) {
        // alert('요청하신 게임은 전일 시세정보만 제공합니다.');
        // var strUrl = '/game_info/money/index?gamecode=125&servercode=11523';
        // if (bPop) {
        //     strUrl += '&win=pop';
        // }
        // location.href = strUrl;
    }

    serverLoad(g_game_code);

    $('#gamelist').change(function() {
        if ($(this).val().isEmpty()) {
            alert('게임을 선택해 주세요.');
            return false;
        }
        g_game_code = $(this).val();
        g_game_code_name = $(this).get(0).options[$(this).get(0).options.selectedIndex].innerHTML;
        serverLoad(g_game_code);
    });

    $('#serverlist').change(function() {
        if ($(this).val().isEmpty()) {
            alert('서버를 선택해 주세요.');
            return false;
        }
        g_server_code = $(this).val();
        serverLoad(g_game_code);
    });

    $('#btnView').click(function() {
        btnView(15);
    });
    btnView(15);

    if (sType == 'all') {
        $('#dv_server_by').css('display', 'none');
        $('#dv_server_by_all').css('display', 'block');
    } else {
        $('#dv_server_by').css('display', 'block');
        $('#dv_server_by_all').css('display', 'none');
    }
}

function btnView(nday) {
    if (g_server_code == 0) {
        $('#dv_server_by').css('display', 'none');
        $('#dv_server_by_all').css('display', 'block');
        $.fnajax_recom_game(g_game_code, g_game_code_name);
    } else {
        $('#dv_server_by').css('display', 'block');
        $('#dv_server_by_all').css('display', 'none');

        $('#exchanger')[0].reset();
        $('#loading_img').show();
        $('#tbl_money_list_01').html('<tr><td colspan=\'4\'><img src=\'' + IMG_DOMAIN2 + '/images/icon/loadinfo.gif\' width=\'24\' height=\'24\' alt=\'\' /></td></tr>');
        $('#tbl_money_list_02').html('<tr><td colspan=\'4\'><img src=\'' + IMG_DOMAIN2 + '/images/icon/loadinfo.gif\' width=\'24\' height=\'24\' alt=\'\' /></td></tr>');

        g_gs_name = g_game_code_name + '>' + g_server_code_name;
        var checked = new Array();
        if (nday == 15) {
            checked[0] = 'checked';
            checked[1] = '';
        } else {
            checked[0] = '';
            checked[1] = 'checked';
        }

        var txtSearch = '<div class=\'float-left\'><strong>' + g_gs_name + ' 일별 시세 그래프</strong><span id="avr_range"></span></div>  ';
        txtSearch += '<div class="float__right"><input type=\'radio\' name=\'slt_cnt\' id=\'slt_cnt15\' onclick=\'$.btnView(15);\' class=\'g_radio\' ' + checked[0] + '> <label for=\'slt_cnt15\'>최근15일</label>  ';
        txtSearch += '<input type=\'radio\' name=\'slt_cnt\' id=\'slt_cnt90\' onclick=\'$.btnView(90);\' class=\'g_radio\' ' + checked[1] + '> <label for=\'slt_cnt90\'>최근 3개월(90일)</label></div><div class="empty-high"></div>';
        $('#lbl_graph_title').html(txtSearch);

        $.fnajax_money(g_game_code, g_server_code, nday, g_gs_name);
    }
}


function serverLoad(gamecode) {
    serverlist = $('#serverlist');
    serverlist.find('option').remove();
    var length = serverName[gamecode].length;
    var option = null;
    var tmp = 0;
    var bslt = false;
    var k = 0;
    for (i = 0; i < length; i++) {
        if (serverName[gamecode][i] != undefined) {

            if (k == 0) {
                option = document.createElement('OPTION');
                option.value = '0';
                option.appendChild(document.createTextNode('서버전체'));
                serverlist.append(option);
            }

            option = document.createElement('OPTION');
            option.value = serverCode[gamecode][i];
            option.appendChild(document.createTextNode(serverName[gamecode][i]));
            if (g_server_code == serverCode[gamecode][i]) {
                bslt = true;
                g_server_code = serverCode[gamecode][i];
                g_server_code_name = serverName[gamecode][i];
                option.setAttribute('selected', 'selected');
            }
            serverlist.append(option);
            if (tmp < serverName[gamecode][i].length) {
                tmp = serverName[gamecode][i].length;
            }
            k++;
        }
    }

    if (!bslt) {
        serverlist.get(0).options[0].setAttribute('selected', 'selected');
        g_server_code = serverlist.val();
        g_server_code_name = serverlist.get(0).options[0].innerHTML;
    }

    $('#serverlist_slt').css('width', ((tmp * 15) + 30) + 'px');
}

$.extend({
    btnView: function(nday) {
        btnView(nday);
    },
    fnmoneyUnitChange: function(money) {
        var money = '' + money;
        var reTuenMoney = '';
        var moneyString = new Array(money.length);
        var unitString = new Array('', '만', '억', '조', '경');
        var tmpNumber = '';

        if (money.length > 4) {
            for (var i = 0; i < money.length; i++) {
                moneyString[i] = money.substr(i, 1);
            }
            var x = 1;
            var y = 0;
            for (i = money.length; i > 0; i--) {
                tmpNumber = moneyString[i - 1] + tmpNumber;
                if (x % 4 == 0) {
                    if (Number(tmpNumber) > 0) {
                        reTuenMoney = (Number(tmpNumber).currency()) + unitString[y] + reTuenMoney;
                    }
                    tmpNumber = '';
                    y++;
                }
                x++;
            }
            if (tmpNumber.length > 0) {
                reTuenMoney = (Number(tmpNumber).currency()) + unitString[y] + reTuenMoney;
            }
        } else {
            reTuenMoney = Number(money).currency();
        }
        return reTuenMoney;
    },
    fnajax_money_all: function(game_code) {
    },
    fnajax_money: function(game_code, servercode, cnt, gs_code_name) {
        $.ajax({
            url: '/api/_xml/gamemoney_avg.xml',
            dataType: 'xml',
            type: 'GET',
            data: 'gamecode=' + game_code + '&servercode=' + servercode + '&count=' + cnt,
            success: function(xml) {

                labelsLength = 5;

                var strUnit = $(xml).find('quotation').attr('multiple') + $(xml).find('quotation').attr('unit_trade') + ' ' + $(xml).find('quotation').attr('denomination');
                //var txtSearch = '<div class=\'avr_day\'>(' + strUnit + '당)</div><div class=\'empty-high\'></div>';
                //$('#lbl_graph_title').append(txtSearch);

                if ($(xml).find('quotation').attr('result') == 'fail') {
                    alert($(xml).find('quotation').attr('result_descript'));
                    $('#serverlist').val('0');
                    g_server_code = 0;
                    btnView(15);
                    return;
                }

                var dateStart = $(xml).find('quotation').attr('dateStart');
                var dateEnd = $(xml).find('quotation').attr('dateEnd');
                var nCnt = $(xml).find('quotation').attr('count');
                var nAvgPrice = $(xml).find('quotation').attr('nAvgPrice');
                var minRlt = $(xml).find('quotation').attr('min_result');
                var unitTxt = $(xml).find('quotation').attr('denomination');
                var extra_info = ' <span class=\'text-blue_modern\'> 일 평균 ' + Number(nAvgPrice).currency() + '원</span>';

                /* ▼ 환율계산정보 */
                money_unit = $(xml).find('quotation').attr('unit_trade');
                money_standard = $(xml).find('quotation').attr('multiple');
                money_date = $(xml).find('quotation > data').attr('date');
                money_avg = $(xml).find('quotation > data').attr('price');
                $('#txtUnitMoney').text(money_unit + ' ' + unitTxt);
                $('#dvStandard').html('<span>'+ money_standard + money_unit + '당 ' + Number(money_avg).currency() + '원</span><br><span>(' + money_date + ' 기준)</span>');
                /* ▲ 환율계산정보 */

                /* ▼ 차트데이터 처리 */
                var rgDate = new Array();
                var rgSrvPrice = new Array();
                var rgMinSrvPrice = new Array();
                var i = 0;

                $('#tbl_money_list_01').html('');
                $('#tbl_money_list_02').html('');
                $(xml).find('quotation > data').each(function() {
                    /* ▼ 일자 별 시세 등락 폭 */
                    var strDate = $(this).attr('date').replace(/\//g, '-');
                    var tr_row = '<tr><td>' + strDate + '</td><td>' + Number($(this).attr('price')).currency() + '</td>';
                    if ($(this).attr('amount_type') == 'down') {
                        tr_row += '<td class=\'g_blue1\'><img src=\'' + IMG_DOMAIN4 + '/images/icon/ico_p_down.gif\'>' + Number($(this).attr('amount')).currency() + '</td>';
                    } else if ($(this).attr('amount_type') == 'none') {
                        tr_row += '<td class=\'g_black1\'>-</td>';
                    } else {
                        tr_row += '<td class=\'text-rock\'><img src=\'' + IMG_DOMAIN4 + '/images/icon/ico_p_up.gif\'>' + Number($(this).attr('amount')).currency() + '</td>';
                    }
                    if (minRlt == 'fail') {
                        tr_row += '<td>-</td></tr>';
                    } else {
                        tr_row += '<td>' + Number($(this).attr('min_price')).currency() + '</td></tr>';
                        rgMinSrvPrice.push(Number($(this).attr('min_price')));
                    }
                    if (i++ < Math.ceil(nCnt / 2)) {
                        $('#tbl_money_list_01').append(tr_row);
                    } else {
                        $('#tbl_money_list_02').append(tr_row);
                    }
                    /* ▲ 일자 별 시세 등락 폭 */
                    rgDate.push(strDate.substr(5));
                    rgSrvPrice.push(Number($(this).attr('price')));
                });

                rgDate.reverse();
                rgSrvPrice.reverse();
                if (minRlt == 'success') {
                    rgMinSrvPrice.reverse();
                }

                function objSetter(y, color) {
                    this.y = y;
                    this.color = color;
                }

                /* ▲ 차트데이터 처리 */

                var chartWidth = 780;
                var canvas = document.getElementById('container');
                var ctx = document.getElementById('container').getContext('2d');
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                $('#loading_img').hide();
                $(canvas).attr({
                    'width': chartWidth
                });
                $('#graph_size_control').css({
                    'width': chartWidth + 'px'
                });
                $('#lbl_graph_title').append('<div class="graph_info">' + extra_info + '(' + strUnit + '당)</div>');
                $('#avr_range').text('최근 ' + nCnt + '일 제공 : ' + dateStart + ' ~ ' + dateEnd + ' ')
                var chartData = {
                    labels: rgDate,
                    datasets: [{
                        label: '평균가',
                        borderColor: '#159EFD',
                        backgroundColor: '#159EFD',
                        fill: false,
                        data: rgSrvPrice,
                        yAxisID: 'y-axis-1'
                    }, {
                        label: '최저가',
                        borderColor: '#12CFA9',
                        backgroundColor: '#12CFA9',
                        fill: false,
                        data: rgMinSrvPrice,
                        yAxisID: 'y-axis-1'
                    }]
                };

                var options = {
                    maintainAspectRatio: false,
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    legend: {
                        position: 'top',
                        align:'start'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                if (label) {
                                    label += ': ';
                                }

                                label += tooltipItem.yLabel.currency() + '원';
                                return label;
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 20
                        }
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true,
                                drawBorder: true,
                                drawOnChartArea: false
                            },
                            ticks: {
                                fontFamily: '맑은고딕, Malgun Gothic, sans-serif',
                                maxRotation: 0,
                                padding: 10,
                                autoSkip: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: '#EFF0F2',
                                drawTicks: false
                            },
                            display: true,
                            position: 'left',
                            id: 'y-axis-1',
                            ticks: {
                                fontFamily: '맑은고딕, Malgun Gothic, sans-serif',
                                position: 'top',
                                padding: 10,
                                callback: function(d) {
                                    return d.currency() + '원';
                                }
                            }
                        }, {
                            display: false,
                            id: 'y-axis-2'
                        }]
                    }
                };

                var min = Math.min(rgSrvPrice);
                var max = Math.max(rgSrvPrice);

                if (max - min < 100) {
                    options.scales.yAxes[0].ticks.min = rgSrvPrice[0] - 100 - (rgSrvPrice[0] % 100);
                    options.scales.yAxes[0].ticks.stepSize = 100;
                }

                if (chart === undefined) {
                    chart = new Chart(ctx, {
                        data: chartData,
                        type: 'line',
                        options: options
                    });
                } else {
                    if (cnt > 15) {
                        // options.scales.xAxes[0].ticks.autoSkip = true;
                        // options.scales.xAxes[0].ticks.autoSkipPadding = 20;
                        options.scales.xAxes[0].ticks.callback = function(item, index) {
                            var c = Math.ceil(cnt / 15);
                            if (!(index % c)) {
                                return item;
                            }
                        };
                        chartData.datasets[0].pointRadius = 0;
                        chartData.datasets[1].pointRadius = 0;
                    }
                    chart.chart.width = chartWidth;
                    chart.config.type = 'line';
                    chart.config.data = chartData;
                    chart.options = options;
                    chart.update();
                }
            },
            error: function() {

            }
        });
    },
    fnajax_recom_game: function(game_code, game_code_name) {
        $.ajax({
            url: '/_xml/gamemoney_servers.xml.php',
            dataType: 'xml',
            type: 'GET',
            data: 'gamecode=' + game_code,
            success: function(xml) {

                labelsLength = 0;

                var barCtx = document.getElementById('container').getContext('2d');
                var barBackground = barCtx.createLinearGradient(0, 0, 0, 250);
                barBackground.addColorStop(0, '#159EFD');
                barBackground.addColorStop(1, '#12CFA9');


                if ($(xml).find('list').attr('result') == 'na') {
                    alert('nothing');
                    return;
                }
                if ($(xml).find('list').attr('result') == 'fail') {
                    alert('faile');
                    return;
                }
                var rgMinServer = $(xml).find('list').attr('min_server').split('|');
                var rgMaxServer = $(xml).find('list').attr('max_server').split('|');
                var store_date = $(xml).find('list').attr('store_date');
                var nAvgPrice = $(xml).find('list').attr('nAvgPrice');
                var nCnt = $(xml).find('list').attr('count');
                var avgPrice = Number(nAvgPrice).currency() == 'NaN' ? 0 : Number(nAvgPrice).currency();
                var maxPrice = Number(rgMaxServer[2]).currency() == 'NaN' ? 0 : Number(rgMaxServer[2]).currency();
                var minPrice = Number(rgMinServer[2]).currency() == 'NaN' ? 0 : Number(rgMinServer[2]).currency();
                var extra_info = '<span class=\'blue\'><img src=\'' + IMG_DOMAIN3 + '/new_images/gameinfo/icon_aver.jpg\' class=\'g_icon\' /> ' + avgPrice + '</span>';
                extra_info += ' <span class=\'red\'><img src=\'' + IMG_DOMAIN3 + '/new_images/gameinfo/icon_high.jpg\' class=\'g_icon\' /> ' + rgMaxServer[0] + maxPrice + '</span>';
                extra_info += ' <span class=\'green\'><img src=\'' + IMG_DOMAIN3 + '/new_images/gameinfo/icon_low.jpg\' class=\'g_icon\' /> ' + rgMinServer[0] + minPrice + '</span>';

                $('#lbl_graph_title').html('<div class=\'all_title\'><strong>' + game_code_name + ' 전체 서버 </strong>' + store_date + '<div class=\'info_wrapper\'>' + extra_info + '</div></div>');

                var rgSrvName = [];
                var rgSrvPrice = [];
                var max2 = 0;
                $(xml).find('list > data').each(function() {
                    var price = $(this).attr('price');
                    rgSrvName.push($(this).attr('name').substr(0, 10));
                    rgSrvPrice.push(Number(price));
                    if (Number(price) < Number(nAvgPrice * 10) && Number(max2) < Number(price)) {
                        max2 = price;
                    }
                });
                if (rgSrvPrice.length > 15) {
                    labelsLength = 3;
                } else if (rgSrvPrice.length > 13) {
                    labelsLength = 4;
                }

                function objSetter(y, color) {
                    this.y = y;
                    this.color = color;
                }

                var chartWidth = 780;
                if (nCnt * 40 >= 780) {
                    chartWidth = nCnt * 40;
                }

                var canvas = document.getElementById('container');
                var ctx = document.getElementById('container').getContext('2d');
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                $('#loading_img').hide();
                $(canvas).attr({
                    'width': chartWidth
                }).show();
                $('#graph_size_control').css({
                    'width': chartWidth + 'px'
                });
                $('#graph_info').html('');

                var chartData = {
                    labels: rgSrvName,
                    datasets: [{
                        backgroundColor: barBackground,
                        hoverBackgroundColor: '#159EFD',
                        fill: false,
                        data: rgSrvPrice,
                        yAxisID: 'y-axis-1'
                    }]
                };

                var options = {
                    maintainAspectRatio: false,
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    legend: false,
                    layout: {
                        padding: {
                            top: 20
                        }
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: true,
                                drawBorder: true,
                                drawOnChartArea: false
                            },
                            ticks: {
                                fontFamily: '맑은고딕, Malgun Gothic, sans-serif',
                                maxRotation: 0,
                                padding: 10,
                                autoSkip: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: '#EFF0F2',
                                drawTicks: false
                            },
                            type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: 'left',
                            id: 'y-axis-1',
                            ticks: {
                                fontFamily: '맑은고딕, Malgun Gothic, sans-serif',
                                position: 'top',
                                padding: 10,
                                min: 0,
                                max: Math.ceil(Number(max2) / zeroAdd(max2.length - 1)) * zeroAdd(max2.length - 1),
                                callback: function(d, index, values) {
                                    return d.currency() + '원';
                                }
                            }

                        }]
                    },
                    tooltips: {
                        position: 'custom',
                        callback: {
                            label: function(tooltip, data) {
                                var label = Math.floor(tooltip.yLabel * 100) / 100 + ' ' + data.datasets[tooltip.datasetIndex].label;
                                return label;
                            }
                        }
                    }
                };

                if (chart === undefined) {
                    chart = new Chart(ctx, {
                        data: chartData,
                        type: 'bar',
                        options: options

                    });
                } else {
                    chart.chart.width = chartWidth;
                    chart.config.type = 'bar';
                    chart.config.data = chartData;
                    chart.options = options;
                    chart.update();
                }
            },
            error: function() {

            }
        });
    }
});

function exchange() {
    var inptMoney = $('#txtMoney');
    var inptExchange = $('#txtExchange');
    var price = inptMoney.val().replace(/[^0-9]/g, '');
    if (price < 1) {
        alert('변환할 금액은 0보다 커야 합니다.');
        inptMoney.val('');
        inptMoney.focus();
        return;
    }

    if (inptMoney.val().isEmpty()) {
        alert('변환할 금액은 0보다 커야 합니다1.');
        inptMoney.val('');
        inptMoney.focus();
        return;
    }
    inptExchange.val(Math.floor((price / money_standard) * money_avg).currency());
}

function zeroAdd(leng) {
    var text = '1';
    for (var i = 0; i < leng; i++) {
        text += '0';
    }
    return Number(text);
}

Chart.plugins.register({
    beforeUpdate: function(chart) {

        chart.data.labels.forEach(function(val, index, arr) {
            if (labelsLength > 0) {
                var a = [];
                a.push(val.slice(0, labelsLength));
                var i = 1;
                while (val.length > (i * labelsLength)) {
                    a.push(val.slice(i * labelsLength, (i + 1) * labelsLength));
                    i++;
                }
                arr[index] = a;
            }

        });
    }
});
Chart.Tooltip.positioners.custom = function(el, eP) {
    return {
        x: eP.x,
        y: eP.y
    };
};
