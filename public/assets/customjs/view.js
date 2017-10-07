$(document).ready(function(){
    /**
     * These group of functions are used to display data 
     * using ajax with datatables integration 
     * which calls to requested API endpoint
     */
    var initialized = varInit();
    if (initialized) { 
        reload();
    }
    /**
    * varInit function
    * used to intialize variables 
    */
    function varInit(){
        for(l=0;l<mandatory.length;l++){
            if(typeof common[mandatory[l]] == "undefined") {
                console.log("object "+mandatory[l]+" not defined yet!");
                return false;
            }
        }
        return true;
    }
    /**
     * reload function
     * used to reload data dynamically 
     * call this function after every action
     */
    function reload() {
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Authorization': common.apiToken,
            },
            url: common.urlID,
            method: 'GET',
        }).done(function(getData){
            console.log(getData);
            if(getData.total == 0) {
                alert("No Data!");
                window.location.href = '/sales/order/view';
            } else {
                $('.table').each(function () {
                    var idName = $(this).attr('id');
                    var tblRows = parseData(idName, getData.data);
                    $('#' + idName).html(tblRows);
                }); 
            }
        });
    }
    /**
     * 
     * @param {*} selectorName 
     * @param {*} dataName 
     */
    function parseData(selectorName, selectorData) {
        var tblRows = "";
        if (selectorData[selectorName].length > 0) {
            for (var val in selectorData[selectorName]) {
                if (val == 0) {
                    tblRows += '<thead><tr>';
                    for (var value in common[selectorName]) {
                        tblRows += '<th>'
                            + common[selectorName][value]
                            + '</th>';
                    }
                    tblRows += '</tr></thead>';
                }
                tblRows += '<tr>';
                for (var value in common[selectorName]) {
                    if (value == 'price' || value == 'qty_price') {
                        selectorData[selectorName][val][value] = nyastUtil.numberFormat(selectorData[selectorName][val][value], 'Rp ');
                    }
                    tblRows += '<td>'
                        + selectorData[selectorName][val][value]
                        + '</td>';
                }
                tblRows += '</tr>';
            }
        } else {
            for (var val in common[selectorName]) {
                var appendData = "";
                if (val == 'total_price') {
                    selectorData[selectorName][val] = nyastUtil.numberFormat(selectorData[selectorName][val], 'Rp ');
                }
                appendData = selectorData[selectorName][val];
                tblRows += '<tr>'
                    + '<td style="width:30%">'
                    + common[selectorName][val]
                    + '</td>'
                    + '<td>'
                    + appendData
                    + '</td>'
                    + '</tr>';
            }
        }
        return tblRows;
    }
});