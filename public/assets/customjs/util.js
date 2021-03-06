/**
 * nyastUtil
 * Custom util with jquery - javascript 
 * author   : moeghifar
 * mail     : ghi.fai@gmail.com
 * github   : github.com/moeghifar
 */
var nyastUtil = (function () {
    return {
        numberFormat : function(valNum,prefix,separator) {
            if (typeof valNum == 'undefined') {
                valNum = "";
            } else {
                valNum = valNum.toString();
            }
            if (typeof prefix == 'undefined') {
                prefix = ''; 
            } else {
                prefix = prefix + ' ';
            }
            if (typeof separator == 'undefined') {
                separator = '.';
            }
            var buildNumberFormat = valNum.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1'+separator);
            return prefix + buildNumberFormat;
        }
    };
})();