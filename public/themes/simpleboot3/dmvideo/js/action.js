define(function (require, exports, module) {
    var $ = require('jquery');
    var layer = require('layer');
    var fn = require('function');
    require('placeholder');
    require('layer-css');
    require('avalon');
    var until = require('until');

    // if(!fn.browserRedirect()){
    //     window.location.replace('http://ztm.epwk'+fn.GetDomainName()+'/1804yingshi/');
    // }

    var lxVm = avalon.define({
        $id: 'lxr',
        data: []
    });
    avalon.scan();

    until.serverAjax('111', function (data) {
        lxVm.data = data;
    });
    
    $('[placeholder]').placeholder();

    if ($('.layer-item').length > 0) {
        var lindex = parent.layer.getFrameIndex(window.name);
    }

    setTimeout(function () {
        $('.footer-submit').removeClass('close-div');
    }, 5000)

    $(document).on('click', '.footer-submit .close', function () {
        $('.footer-submit').addClass('close-div');
    })

    $(document).on('click', '.goto-top a,.goto-top', function () {
        $('html,body').animate({scrollTop: 0}, 1000);
    })

    $(document).on('click', '.chuangyi-tab span', function () {
        var index = $(this).index();
        $(this).parent().removeAttr('class').addClass('chuangyi-tab active' + index);
        $('.chuangyi-wrap > div').hide().eq(index).show();
    })

    /*$(document).on('click', '.video-list li', function () {
        var index = $(this).index();
        var title = $.trim($(this).find('p:first').text());
        layer.open({
            title: title,
            type: 2,
            skin: 'layui-layer-rim',
            closeBtn: 1,
            shade: .8,
            area: ['600px', '460px'],
            content: ['layer.php?action=2&video=' + index, 'no']
        })
    })*/

    $(document).on('click', '.layer-close', function() {
        parent.layer.close(lindex);
    })

    $(document).on('click', '.header-nav span, .left-nav-item span', function () {
        var index = $(this).index(), index = index + 1;
        if (index == 5) {
            layer_open();
            return false;
        }
        if ($(this).parent().attr('class') == 'left-nav-item') {
            $(this).siblings('span').removeClass('active').end().addClass('active');
        }
        $('html,body').animate({scrollTop: $('.page' + index).offset().top}, 500);
    })

    $(document).on('click', '.layer-btn', function () {
        layer_open();
    })

    function layer_open() {
        layer.open({
            title: false,
            type: 2,
            skin: 'layui-layer-rim',
            closeBtn: 1,
            scrollbar: false,
            shade: .8,
            shadeClose: false,
            area: ['500px', '400px'],
            content: ['layer.php?action=1', 'no']
        })
    }

    $(window).on('scroll ready', function () {
        if ($('.layer-item').length > 0) {
            return false;
        }
        var topoff = $(window).scrollTop();
        var p1 = $('.page1').offset().top;
        var p2 = $('.page2').offset().top;
        var p3 = $('.page3').offset().top;
        var p4 = $('.page4').offset().top;
        var p5 = $('.page5').offset().top;

        if (topoff > 500) {
            $('.left-nav').css({left: 20});
        } else {
            $('.left-nav').removeAttr('style');
        }

        if (topoff >= p1 && topoff <= p2) {
            $('.left-nav-item span').removeClass('active');
            $('.left-nav-item span').eq(0).addClass('active');
        }
        if (topoff >= p2 && topoff <= p3) {
            $('.left-nav-item span').removeClass('active');
            $('.left-nav-item span').eq(1).addClass('active');
        }
        if (topoff >= p3 && topoff <= p4) {
            $('.left-nav-item span').removeClass('active');
            $('.left-nav-item span').eq(2).addClass('active');
        }
        if (topoff >= p4 && topoff <= p5) {
            $('.left-nav-item span').removeClass('active');
            $('.left-nav-item span').eq(3).addClass('active');
        }
        if (topoff >= p5) {
            $('.left-nav-item span').removeClass('active');
            $('.left-nav-item span').eq(4).addClass('active');
        }
    })

    $(document).on('click', '.submit-tow-item button', function () {
        var _this = $('.submit-tow-item');
        var u = _this.find('[name="username"]').val();
        var m = _this.find('[name="mobile"]').val();
        SubmitData(_this, u, m);
    })
    $(document).on('click', '.submit-item button', function () {
        var _this = $('.submit-item');
        var u = _this.find('[name="username"]').val();
        var m = _this.find('[name="mobile"]').val();
        SubmitData(_this, u, m);
    })

    $(document).on('keyup', '[name="mobile"]', function () {
        fn.clearstr2(this);
    })

    $(document).on('click', '.layer-submit', function () {
        var _this = $('.layer-item');
        var u = _this.find('[name="username"]').val();
        var m = _this.find('[name="mobile"]').val();
        SubmitData(_this, u, m, lindex);
    })

    function SubmitData(_this, u, m, i) {
        if (u == '') {
            layer.alert('请输入您的姓名', {icon: 2});
            return false;
        }
        if (m == '') {
            layer.alert('请输入您的电话号码', {icon: 2});
            return false;
        }
        if (!fn.regex_check(m, 'mobile')) {
            layer.alert('输入格式错误，请输入11位手机号码', {icon: 2});
            return false;
        }
        _this.find('button').attr('disabled', true);
        $.ajax({
            url: 'http://www.epwk' + fn.GetDomainName() + '/index.php?do=ajax&view=advertis',
            type: 'GET',
            dataType: 'jsonp',
            jsonp: 'callback',
            data: {
                'reg_name': u,
                'reg_username': u,
                'mobile': m,
                'tc_desc': u,
                'way': 1,
                'adv_type': 111
            },
            success: function (json) {
                _this.find('button').attr('disabled', false);
                if (json.status == 1) {
                    _taq.push({convert_id:"1598956501189652", event_type:"form"});
                    _this.find('input').val('');
                    if (i) {
                        layer.alert('请保持手机畅通，我们的工作人员将与您联系',function () {
                            parent.layer.close(i);
                        });
                    } else {
                        layer.alert('请保持手机畅通，我们的工作人员将与您联系', {icon: 1});
                    }
                    return false;
                } else {
                    layer.alert(json.msg, {icon: 2});
                    return false;
                }
            }
        })
    }
})