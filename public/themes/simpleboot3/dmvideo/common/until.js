define(function (require, exports, module) {
    var fn = require('function');
    module.exports = {

        serverAjax:function(sp_id,callback){

            $.ajax({
                url: 'http://www.epwk'+fn.GetDomainName()+'/index.php?do=ajax&view=common&op=zt_contact&sp_id='+sp_id,
                type: 'GET',
                dataType: 'jsonp',
                jsonp: 'callback',
                success: function (json) {
                    if (json.status == 0) {
                        callback(json.data);
                    }
                }
            })

        }


    }



});

