define(function (require, exports, module) {
    require('vue');
    require('vue-resource');
    var until = require('until');
    var vm = new Vue({
        el: '#app',
        data: {
            tel: [],
        }
    })
    until.serverAjax('111', function (data) {
        vm.tel = data;
    });


    function browserRedirect() {
        var sUserAgent = navigator.userAgent.toLowerCase();
        var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
        var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
        var bIsMidp = sUserAgent.match(/midp/i) == "midp";
        var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
        var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
        var bIsAndroid = sUserAgent.match(/android/i) == "android";
        var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
        var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
        if (!(bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM)) {
            return true;
        } else {
            return false;
        }
    };

    function GetDomainName() {
        var url = window.location.host;
        url = url.substring(url.lastIndexOf('.'));
        return url;
    };


    if (browserRedirect()) {
        window.location.replace('http://zt.epwk' + GetDomainName() + '/1804yingshi/');
    }

    //获取后缀
    function GetDomainName() {//获取域名后缀
        var url = window.location.host;
        url = url.substring(url.lastIndexOf('.'));
        return url;
    }

    //底部点击效果
    $('.s-buy2').click( function () {
        $('.foot-dialog').toggle(300);
    });

    //$('#tonghua').click(function () {
    //    event.stopPropagation();
    //    $('.zx').hide();
    //    $('.th').toggle(300);
    //});
    //$('#jiedan').click(function () {
    //    event.stopPropagation();
    //    $('.th').hide();
    //    $('.zx').toggle(300);
    //});
    $('body').click(function () {
        $('footer ul').fadeOut();
    });
    $('body').on('click', '.jiedan', function () {
        $("html,body").animate({ scrollTop: $("#form").offset().top }, 1000);
    });

    $('body').on('click', '.hdtop', function () {
        //$('html').get(0).scrollTop = 0;
        $("html,body").animate({
            scrollTop: 0
        }, "fast")
    });

    function clean() {
        $("#name").val('');
        $("#num").val('');
        $("#name1").val('');
        $("#num1").val('');
    };

    var reg = /^1[34578]{1}\d{9}$/;
    function tijiao(name, num, far) {
        if (name == "") {
            layer.open({
                skin: 'msg',
                time: 2,
                content: '姓名不能为空'
            })
        } else if (num == "") {
            layer.open({
                skin: 'msg',
                time: 2,
                content: '手机号码不能为空'
            })
        } else if (num.match(reg) == null) {
            layer.open({
                skin: 'msg',
                time: 2,
                content: '手机号码格式有误'
            })
        } else {
            $.ajax({
                url: '########',
                type: 'GET',
                dataType: 'jsonp',
                jsonp: 'callback',
                data: {
                    "way": 1,
                    "source": "wap",
                    "mobile": num,
                    "tc_desc": name,
                    "adv_type": 111
                },
                success: function (data) {
                    _taq.push({ convert_id: "1598956501189652", event_type: "form" });
                    // 百度信息流转化
                    window._agl && window._agl.push(['track', ['success', { t: 3 }]])
                    if (data.status == 1) {
                        layer.open({
                            skin: 'msg',
                            content: "提交成功！",
                            time: 2
                        });
                        clean();
                        setTimeout(function () {
                            layer.closeAll();
                        }, 2000)
                    } else {
                        layer.open({
                            skin: 'msg',
                            content: data.msg,
                            time: 2
                        });
                    }
                },
                error: function (data) {
                    layer.open({
                        skin: 'msg',
                        content: data.msg,
                        time: 2
                    });
                }
            })
        }
    }

    $('body').on('click', '#tj', function () {
        var name = $('#name').val();
        var num = $('#num').val();
        tijiao(name, num, 0);
    });
    $('body').on('click', '#tj1', function () {
        var name = $('#name1').val();
        var num = $('#num1').val();
        tijiao(name, num, 1);
    });

    $("#hdtop").click(function () {
        var h = $('body').height() - $(window).height();
        $("html,body").animate({
            scrollTop: h
        }, "fast")
    });

    //$('body').on('click','#hdtop',function () {
    //    $("html,body").animate({
    //        scrollTop:0
    //    },"fast")
    //});
})

