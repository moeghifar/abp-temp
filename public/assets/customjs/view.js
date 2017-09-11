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
            console.log(getData.data);
            // var jsonData = buildData(getData.data);
            // var jsonCol = buildColumn(common.outputColumn);
            // renderTable(jsonData, jsonCol);
        });
    }
    /**
     * buildData function
     * used to build data by embedding necessary data parameters such result_order & result_action 
     */
    function buildData(jData){
        for(lp = 0; lp < jData.length; lp++){
            if (typeof jData[lp][common.idName + "_id"] == "undefined") {
                id = jData[lp]["id"];
            } else {
                id = jData[lp][common.idName + "_id"];
            }
            var actionWrapper = "<span data-id='"+id+"'>"+common.actionButton+"</span>";
            jData[lp].price = nyastUtil.numberFormat(jData[lp].price,'Rp '); 
            jData[lp].result_order = lp+1;
            jData[lp].result_action = actionWrapper;
        }
        return jData;
    }
    /**
     * buildColumn function
     * used to build column which the result will be used by datatables
     */
    function buildColumn(cData){
        var coData = [];
        for(lp = 0; lp < cData.length; lp++){
            var cObj = {};
            cObj.data = cData[lp];
            coData.push(cObj); 
        }
        return coData;       
    }
    /**
     * renderTable function
     * used to render datatable based on data and column generated before
     */
    function renderTable(jsonData, jsonCol){
        var tabel = $("#datatable-custom-table").DataTable();
        tabel.destroy();    
        tabel = $("#datatable-custom-table").DataTable({
            "data"          : jsonData,
            "columns"       : jsonCol,
            "aoColumnDefs"  : [
                { "bSortable": false, "aTargets": ["_all"] }
            ]
        });
    }   
});