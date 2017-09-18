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
            // console.log(getData.data);
            var tblRows = buildData(getData.data);
            $('.table').html(tblRows);
        });
    }
    /**
     * buildData function
     * 
     */
    function buildData(bData) {
        var tblRows = "";
        for (var val in common.dataOutput) {
            console.log(val + " -> " + bData[val]);
            // if (typeof bData[val] != "undefined") {
                if( val == 'total_price') {
                    bData[val] = nyastUtil.numberFormat(bData[val],'Rp ');
                }
                tblRows += '<tr>'
                    + '<td>'
                    + common.dataOutput[val]
                    + '</td>'
                    + '<td>'
                    + bData[val]
                    + '</td>'
                    + '</tr>';
            // }
        }
        return tblRows;
    }
});