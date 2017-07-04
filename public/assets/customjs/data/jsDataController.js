$(document).ready(function(){
    function varInit(){
        for(l=0;l<mandatory.length;l++){
            if(typeof common[mandatory[l]] == "undefined") {
                console.log("object "+mandatory[l]+" not defined yet!");
                return false;
            }
        }
        return true;
    }
    var initialized = varInit();
    if (initialized) { 
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
    }
});