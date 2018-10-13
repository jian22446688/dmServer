/**
 * Created by Administrator on 2018/10/9.
 */

//验证输入框字节，返回已输入字节数,strings计算的字符，T=1中文为一个字节，默认中文为两个字节
function d_strlen (strings, t) {
    if (strings == null) return false;
    var reg = '/<[^>]*>/', len = 0, str = strings.replace(reg, strings);
    if (t == 1) {
        len = str.length;
    } else {
        for (var i = 0; i < str.length; i++) {
            var c = str.charCodeAt(i);
            //单字节加1
            if ((c >= 0x0001 && c <= 0x007e) || (0xff60 <= c && c <= 0xff9f)) {
                len++;
            } else {
                len += 2;
            }
        }
    }
    return len;
}

function d_regex_check(str, reg) {
    var regexEnum = {
        mobile: "^1[3456789]\\d{9}$",//手机
        letter: "^[A-Za-z]+$",//字母
        letter_u: "^[A-Z]+$",//大写字母
        letter_l: "^[a-z]+$",//小写字母
        email: "^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$", //邮件
        date: "^\\d{4}(\\-|\\/|\.)\\d{1,2}\\1\\d{1,2}$",	//日期
        idcard: "^(\\d{15}$|^\\d{18}$|^\\d{17}(\\d|X|x))$"	//身份证
    };
    var strings = str.replace(/(^\s*)|(\s*$)/g, ""), strings = strings.replace(/(\s*$)/g, "");
    var r = eval("regexEnum." + reg);
    var result = (new RegExp(r)).test(strings);
    return result;
}

//只允许输入数字
function d_clearstr2(inputobj) {
    inputobj.value = inputobj.value.replace(/[^0123456789]/g, '');
}

//判断是否PC或移动端true:PC false Mobile
function d_browserRedirect() {
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
}

function d_startmarquee(lh, speed, delay, index) {
    var t;
    var p = false;
    var o = document.getElementById("marqueebox" + index);
    if (o == null) return false;
    o.innerHTML += o.innerHTML;
    o.onmouseover = function () {
        p = true;
    }
    o.onmouseout = function () {
        p = false;
    }
    o.scrollTop = 0;

    function start() {
        t = setInterval(scrolling, speed);
        if (!p) {
            o.scrollTop += 2;
        } else {
            o.scrollTop == o.scrollTop;
        }
    }

    function scrolling() {
        if (o.scrollTop % lh != 0) {
            o.scrollTop += 2;
            if (o.scrollTop >= o.scrollHeight / 2) o.scrollTop = 0;
        } else {
            clearInterval(t);
            setTimeout(start, delay);
        }
    }

    setTimeout(start, delay);
}

//获取域名后缀
function d_GetDomainName() {
    var url = window.location.host;
    url = url.substring(url.lastIndexOf('.'));
    return url;
}

//即时通讯 IM
function d_message_im(obj) {
    $(obj).click(function () {
        var tTop = parseInt((screen.height - 750) / 2);
        var tLeft = parseInt((screen.width - 944) / 2);
        window.open('http://v3.faqrobot.org/robot/epwk.html?sysNum=146060474802411160', '厦门一品威客网络科技有限公司', 'width=944,height=750,left=' + tLeft + ',top=' + tTop + '')
    })
}

/**生成随机手机号*/
function d_getMoble(ast) {
    var prefixArray = new Array("130", "131", "132", "133", "135", "137", "138", "170", "187", "189");
    var i = parseInt(10 * Math.random());
    var prefix = prefixArray[i];
    if (ast == 1) {
        prefix = prefix + '****';
        for (var j = 0; j < 4; j++) {
            prefix = prefix + Math.floor(Math.random() * 10);
        }
    } else {
        for (var j = 0; j < 8; j++) {
            prefix = prefix + Math.floor(Math.random() * 10);
        }
    }
    return prefix;
}

/**
 * 随机生成百家姓
 */
function d_getName() {
    var familyNames = new Array("赵", "钱", "孙", "李", "周", "吴", "郑", "王", "冯", "陈", "褚", "卫", "蒋", "沈", "韩", "杨", "朱", "秦", "尤", "许", "何", "吕", "施", "张", "孔", "曹", "严", "华", "金", "魏", "陶", "姜", "戚", "谢", "邹", "喻", "柏", "水", "窦", "章", "云", "苏", "潘", "葛", "奚", "范", "彭", "郎", "鲁", "韦", "昌", "马", "苗", "凤", "花", "方", "俞", "任", "袁", "柳", "酆", "鲍", "史", "唐", "费", "廉", "岑", "薛", "雷", "贺", "倪", "汤", "滕", "殷", "罗", "毕", "郝", "邬", "安", "常", "乐", "于", "时", "傅", "皮", "卞", "齐", "康", "伍", "余", "元", "卜", "顾", "孟", "平", "黄", "和", "穆", "萧", "尹");
    var maxNum = familyNames.length - 1, minNum = 0;
    var i = parseInt(Math.random() * (maxNum - minNum + 1) + minNum);
    var familyName = familyNames[i];
    return familyName;
}

/**
 * 获取IP地址返回省市VAL
 */
function d_getIp_val(callback) {
    $.ajax({
        url: 'http://www.epwk' + this.GetDomainName() + '/index.php?do=ajax&view=common&op=get_area_info',
        type: 'POST',
        dataType: 'jsonp',
        jsonp: 'callback',
        async: false,
        data: {way: 1},
        success: function (json) {
            var p = (json.data.prov_id) ? json.data.prov_id : null;
            var c = (json.data.city_id) ? json.data.city_id : null;
            callback(p, c);
        }
    })
}

function d_GetUrlPara () {
    var url = document.location.toString();
    var arrUrl = url.split("?");
    var para = arrUrl[1];
    para = (typeof para == 'undefined') ? '' : '?' + para;
    return para;
}

//跨域设置access_origin（cookie）
function d_GetRefErrer() {
    if (document.referrer) {
        var iframe = document.createElement('iframe');
        iframe.src = "http://zt.epwk" + this.GetDomainName() + "/common_php/setcookie.php?access_origin=" + encodeURIComponent(document.referrer);
        iframe.style.display = 'none';
        document.body.appendChild(iframe);
    }
}

/**
 * 发送手机验证码
 * @param m
 */
function d_sendMessage(m, _this) {
    var $this= this;
    $.ajax({
        type: 'POST',
        url: 'http://ajax.epwk' + this.GetDomainName() + '/index.php?do=ajax&view=send_code&auth=register&type=mobile&ignore_code=1&condit=mobile&auth_mobile=1',
        dataType: 'jsonp',
        data:{mobile:m},
        jsonp: 'callback',
        success: function (json) {
            var t=(json.status==1)?1:2;
            layer.alert(json.msg,{icon:t});
            if(t==1){
                $this.countdown(_this,60)
            }else{
                if($.cookie(_this.id)>0){
                    $this.countdown(_this,60);
                }
            }

            return false;
        },
        error: function () {
            layer.alert("服务器繁忙，请稍后再试！", {icon: 2});
            return false;
        }
    });
}

/**
 * 验证码倒计时
 * @fun countdown()
 * @par _this当前对象 wait计时长度
 */
function d_countdown(_this, wait) {
    if (parseInt($.cookie(_this.id)) >= 0) {
        wait = parseInt($.cookie(_this.id));
        $.cookie(_this.id, wait - 1);
    } else {
        $.cookie(_this.id, wait - 1);
    }
    if (parseInt($.cookie(_this.id)) < 0) {
        $.cookie(_this.id, '');
    }
    if (wait == 0) {
        _this.innerHTML = '重获验证码';
        _this.removeAttribute("disabled");
        _this.setAttribute('class', "button");
    } else {
        _this.innerHTML = wait + "秒后重新获取";
        _this.setAttribute("disabled", true);
        _this.setAttribute('class', "button disabled");
        wait--;
        setTimeout(function () {
                module.exports.countdown(_this, wait);
            },
            1000);
    }
}