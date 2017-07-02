$(document).ready(function(){
    $.ajax({
        headers : {
            'Accept': 'application/json',
            'Authorization': ajaxApiToken,
        },
        url: ajaxUrl,
        method: 'GET',
    }).done(function(getData){
        var jsonData = buildData(getData.data);
        var jsonCol = buildColumn(ajaxOutputColumn);
        renderTable(jsonData, jsonCol);
    });
    function buildData(jData){
        for(lp = 0; lp < jData.length; lp++){
            jData[lp].result_order = lp+1;
            jData[lp].result_action = ajaxAction;
        }
        return jData;
    }
    function buildColumn(cData){
        var coData = [];
        for(lp = 0; lp < cData.length; lp++){
            var cObj = {};
            cObj.data = cData[lp];
            coData.push(cObj); 
        }
        return coData;       
    }
    function renderTable(jsonData, jsonCol){
        $("#datatable-custom-table").DataTable({
            processing    : true,
            bSort         : false,
            data          : jsonData,
            columns       : jsonCol
        });    
    }
});