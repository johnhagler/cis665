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
        
    },

    userLogout : function () {
        sessionStorage.removeItem('user');
    },

    /**
     * Underscore string descending sortBy
     * usage:
     *   Sort by name ascending `_.sortBy(data, string_comparator('name'));`
     *   Sort by name descending `_.sortBy(data, string_comparator('-name'));`
     */
    string_comparator : function(param_name, compare_depth) {
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
    },

    number_comparator : function (param_name) {
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
    },

    Validate: {

        showError: function (el, msg) {
            msg = msg == undefined ? '' : msg;

            var elId = $(el).attr('id');
            var label = $('label[for=' + elId + ']').html();
            $(el).addClass('error');

            if ($('#err_' +  elId).length == 0) {
                $(el).after('<small id="err_' + elId + '" class="error">' + label + ' ' + msg + '</small>');
            }

        },

        hideError:  function (el) {
            var elId = $(el).attr('id');
            $(el).removeClass('error');
            $('#err_' +  elId).remove();
        },

        required: function (el) {
            
            if ($(el).val().length == 0) {

                var msg = 'connot be left blank';
                App.Validate.showError(el, msg);
                return false;

            } else {

                App.Validate.hideError(el);
                return true;

            }
        },
        minLength: function (el, min) {

            min = min == undefined ? 0 : min;

            if ($(el).val().length < min) {
                
                var msg = 'must be at least ' + min + ' characters';
                App.Validate.showError(el, msg);
                return false;

            } else {

                App.Validate.hideError(el);
                return true;

            }
        }
    }

}


