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
            url: common.ajaxGetUrl,
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
            var actionWrapper = "<span data-id='"+jData[lp].supplier_id+"'>"+common.ajaxAction+"</span>";
            jData[lp].result_order = lp+1;
            jData[lp].result_action = actionWrapper;
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
        var tabel = $("#datatable-custom-table").DataTable();
        tabel.destroy();    
        tabel = $("#datatable-custom-table").DataTable({
            processing    : true,
            bSort         : false,
            data          : jsonData,
            columns       : jsonCol
        });
    }   
    // Modal event listener
    $('body').on('click', '#btnAction', function(){
        var action = $(this).data('action');
        // clear input form
        $('#formContainer input').val("");
        // clear error info
        $("#formContainer #errorContainer").remove();
        if (action == 'add' || action == 'edit') {
            if (action == 'edit') {
                // append html and perform ajax data binding if required
                var getId = $(this).parent().data('id');
                generateEditForm(getId);
            }
            var actionInput = '<input type="hidden" name="_action" value="'+action+'">';
            $('#appendContainer').html(actionInput);
            $("#modalForm").modal('toggle');
        } else if (action == 'delete'){
            var getId = $(this).parent().data('id');
            alert('delete'+getId);
        } else {
            alert('Wrong action type!');
        }
    });
    function generateEditForm(id){
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Authorization': common.ajaxApiToken,
            },
            url: common.ajaxIdUrl+id,
            method: 'GET',
        }).success(function(data){
            // append hidden to modal form
            var idInput = '<input type="hidden" name="id" value="'+id+'">';
            $('#appendContainer').append(idInput);
            // append data to html 
            parseDataToHtml(data.data);
        });
    }
    /**
     * Group of functions to add new data using dialog
     * 
     */
    $("body").on("submit", "#formContainer", function(e){
        var serializedInput = $(this).serializeArray();
        var submitedData = generateRawJson(serializedInput);
        var action = submitedData._action;
        var id = submitedData.id;
        var ajaxUri, ajaxMethod;
        console.log(JSON.stringify(submitedData));
        if (action == 'add') {
            ajaxMethod = 'POST';
            ajaxUri = common.ajaxAddUrl;
        } else if (action == 'edit') {
            ajaxMethod = 'PUT';
            ajaxUri = common.ajaxIdUrl+id;
        } else {
            alert('Wrong action type!');
        }
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Content-Type' : 'application/json',
                'Authorization': common.ajaxApiToken,
            },
            data: JSON.stringify(submitedData),
            url: ajaxUri,
            method: ajaxMethod,
        }).error(function(data){
            // handle error
            console.log("Error Occured!");
            var fixError = parseErrorToHtml(data.responseJSON);
            $("#errorContainer").html(fixError);
        }).success(function(data){
            // success handler
            console.log("OK Succeed!");
            
            // close dialog
            $('#modalForm').modal('hide');
            // reload data
            reload();
            // send notification
            // .... not implemented yet ...
        });
        e.preventDefault();
        return false;
    });
    function generateRawJson(UnindexedArray) {
        var IndexedArray = {};
        $.map(UnindexedArray, function(n, i){
            IndexedArray[n['name']] = n['value'];
        });
        return IndexedArray;
    }
    function parseErrorToHtml(error) {
        $.each(error, function(key, val) {
            var errValue = '<div id="errorContainer" style="color:red;font-size:9pt;">'+val+'</div>';
            $("#formContainer input[name='"+key+"']").next().html(errValue);
        });
    }
    function parseDataToHtml(data) {
        $.each(data, function(key, val) {
            $("#formContainer input[name='"+key+"']").val(val);
        });
    }
});