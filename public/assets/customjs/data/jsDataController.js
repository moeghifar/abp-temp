$(document).ready(function(){
    /**
     * 
     * These group of functions are used to display data 
     * using ajax with datatables integration 
     * which calls to requested API endpoint
     * 
     */

    var initialized = varInit();
    if (initialized) { 
        reload();
    }

    /* used to intialize variables */
    function varInit(){
        for(l=0;l<mandatory.length;l++){
            if(typeof common[mandatory[l]] == "undefined") {
                console.log("object "+mandatory[l]+" not defined yet!");
                return false;
            }
        }
        return true;
    }

    /* used to load data */
    function reload() {
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Authorization': common.ajaxApiToken,
            },
            url: common.ajaxUrl,
            method: 'GET',
        }).done(function(getData){
            var jsonData = buildData(getData.data);
            var jsonCol = buildColumn(common.ajaxOutputColumn);
            renderTable(jsonData, jsonCol);
        });
    }

    /* used to build data by embedding necessary data parameters such result_order & result_action */
    function buildData(jData){
        for(lp = 0; lp < jData.length; lp++){
            jData[lp].result_order = lp+1;
            jData[lp].result_action = common.ajaxAction;
        }
        return jData;
    }
    /* used to build column which the result will be used by datatables */
    function buildColumn(cData){
        var coData = [];
        for(lp = 0; lp < cData.length; lp++){
            var cObj = {};
            cObj.data = cData[lp];
            coData.push(cObj); 
        }
        return coData;       
    }
    /* used to render datatable based on data and column generated before */
    function renderTable(jsonData, jsonCol){
        $("#datatable-custom-table").DataTable({
            processing    : true,
            bSort         : false,
            data          : jsonData,
            columns       : jsonCol
        });    
    }   

    /**
     * Group of functions to add new data using dialog
     * 
     */
    $("#modal_form").on("submit", function(e){
        console.log($(this).serialize());
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Authorization': common.ajaxApiToken,
            },
            url: common.ajaxUrl,
            method: 'POST',
        }).done(function(getData){
            var jsonData = buildData(getData.data);
            var jsonCol = buildColumn(common.ajaxOutputColumn);
            renderTable(jsonData, jsonCol);
        });
        e.preventDefault();
        return false;
    });
});