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