/**
 * Underscore string descending sortBy
 * usage:
 *   Sort by name ascending `_.sortBy(data, string_comparator('name'));`
 *   Sort by name descending `_.sortBy(data, string_comparator('-name'));`
 */
var string_comparator = function(param_name, compare_depth) {
    if (param_name[0] == '-') {
        param_name = param_name.slice(1),
        compare_depth = compare_depth || 10;
        return function (item) {
             return String.fromCharCode.apply(String,
                _.map(item[param_name].slice(0, compare_depth).split(""), function (c) {
                    return 0xffff - c.charCodeAt();
                })
            );
        };
    } else {
        return function (item) {
            return item[param_name];
        };
    }
};

var number_comparator = function (param_name) {
    if (param_name[0] == '-') {
        param_name = param_name.slice(1);
        return function (item) {
            return Number(item[param_name]) * -1;
        };
    } else {
        return function (item) {
            return Number(item[param_name]);
        };
    }
}





var App =  {

    getUrlParams: function (){
        var obj = {};
        var url = location.href.split("?");

        if (url.length > 1) {
            var hash = url[1],
            split = hash.split('&');

            
            for(var i = 0; i < split.length; i++){
                var kv = split[i].split('=');
                obj[kv[0]] = decodeURIComponent(kv[1] ? kv[1].replace(/\+/g, ' ') : kv[1]);
            }
        }
        
        return obj;
        
    },

    getUserDetails : function () {
        
        var data;
        var dataStr = sessionStorage.getItem('user');

        if (dataStr == null || dataStr == 'undefined') {
            
            $.ajax({
                url: '?q=user_details', 
                async: false,
                success: function (dataRtn) {
                    if (dataRtn.user) {
                        data = dataRtn;    
                    }
                }
            });

            sessionStorage.setItem('user',JSON.stringify(data));

        } else {
            data = JSON.parse(dataStr);
        }

        return data;
        
    }

}

var userLogout = function () {
    sessionStorage.removeItem('user');
}
