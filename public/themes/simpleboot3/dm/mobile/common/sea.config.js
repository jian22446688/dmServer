/*配置信息*/
var http_host = window.location.host;
document.write('<script src="http://' + http_host + '/common/seajs-css.js"><\/script>');
seajs.config({
        // Sea.js 的基础路径
        base: http_host + "/m/common/lib/",
        // 别名配置
        alias: {
            "avalon":"/common/avalon/avalon",
            "avalonConfig":'/commom/avalon/avalon.config',
            "jquery": "/common/lib/jquery/jquery",
            "layer": "/common/lib/layer/layer",
            "layer-css": "/common/lib/layer/skin/layer.css",
            "layer-m": "/common/lib/layer/mobile/layer",
            "layer-m-3": "/common/layer3/layer",
            "layer-m-css": "/common/lib/layer/mobile/need/layer.css",
            "layer-m-css-3": "/common/layer3/need/layer.css",
            "placeholder": "/common/lib/jquery.placeholder",
            "jcarousel": "/common/lib/jquery.jcarousel",
            "jcarousellite": "/common/lib/jquery.jcarousellite",
            "chosen": "/common/lib/chosen/chosen.jquery",
            "chosen-css": "/common/lib/chosen/chosen.css",
            "cityselect": "/common/lib/jquery.cityselect",
            "upload": "/common/lib/uploadify/uploadifyhandle",
            "uploadify": "/common/lib/uploadify/jquery.uploadify",
            "uploadify-css": "/common/lib/uploadify/uploadify.css",
            "tipsy": "/common/lib/tipsy/jquery.tipsy",
            "tipsy-css": "/common/lib/tipsy/tipsy.css",
            "delaytab": "/common/lib/jquery.delaytab",
            "validform": "/common/lib/validform/Validform_v5.3.2",
            "validform-css": "/common/lib/validform/validform.css",
            "passwordStrength": "/common/lib/validform/passwordStrength",
            "print": "/common/lib/jquery.print",
            "global": "//Public/js/global",
            "qrcode": "/common/lib/jquery.qrcode",
            "cookie": "/common/lib/jquery.cookie",
            "function": "/common/function",
            "vue": "/common/vue/vue",
            "vue-resource": "/common/vue/vue-resource",
            "until":"/common/until",
            "fastclick": "/common/lib/fastclick",
            "zepto": "/common/lib/zepto",
            "flexible": "/common/lib/flexible",
            "webuploader":"/common/lib/webuploader",
            "swf":'/common/lib/Uploader.swf',
            "swiper":'/common/lib/swiper/swiper',
            "swiper-css":'/common/lib/swiper/swiper.css',
            "SuperSlide": '/common/SuperSlide',
            "swiper_new":'/common/lib/swiper/swiper.min',
            "swiper-css_new":'/common/lib/swiper/swiper.min.css',
        },
        // 'map':[[/^(.*\.(?:css|js))(.*)$/i, '$1?' + JS_VER]],
        // 调试模式
        debug: true,
        // 文件编码
        charset: 'utf-8'
    }
)