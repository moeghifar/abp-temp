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
    /**
     * buildData function
     * used to build data by embedding necessary data parameters such result_order & result_action 
     */
    function buildData(jData){
        for(lp = 0; lp < jData.length; lp++){
            var actionWrapper = "<span data-id='"+jData[lp].supplier_id+"'>"+common.ajaxAction+"</span>";
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
            processing    : true,
            bSort         : false,
            data          : jsonData,
            columns       : jsonCol
        });
    }   
    /**
     * modal event listener
     * this click function will listen #btnAction
     * there are 3 conditions which are add, edit & delete
     */
    $('body').on('click', '#btnAction', function(){
        // read action from `data-action` attribute
        var action = $(this).data('action');
        // clear input form
        $('#formContainer input').val("");
        // clear error info
        $("#formContainer #errorContainer").remove();
        // 1st condition detect if it was add / edit
        if (action == 'add' || action == 'edit') { 
            // 1st nested condition detect if it edit
            if (action == 'edit') {
                // append html and perform ajax data binding if required
                var getId = $(this).parent().data('id');
                // generate edit form by calling generateEditForm function
                generateEditForm(getId);
            }
            // create action input type, used to manipulate ajax form submit
            var actionInput = '<input type="hidden" name="_action" value="'+action+'">';
            // appending action input type above 
            $('#appendContainer').html(actionInput);
            // open modal
            $("#modalForm").modal('toggle');
        } else if (action == 'delete'){
            // get id
            var getId = $(this).parent().data('id');
            // creaete message confirmation to delete data, and append hidden delete_id 
            var msg = '<br/>Delete this data?<br/><br/><input type="hidden" name="delete_id" value="'+getId+'">';
            // do delete by calling confirmWithModal function 
            confirmWithModal(msg);
        } else {
            // last condition detect if the action is malformed
            alert('Wrong action type!');
        }
    });
    /**
     * click button event listener
     * this function will listen #btnYes if yes is clicked
     * then perform delete data using ajax
     */
    $('#modalConfirm').on('click','#btnYes',function(){
        // read id
        var deleteId = $('#modalConfirm input[name="delete_id"]').val();
        // calling delete data with if condition which return true if delete succeed
        if (deleteData(deleteId)) {
            // close modalConfirm
            $('#modalConfirm').modal('toggle');
        }
    });
    /**
     * Submit form event listener
     * this submit listener will execute form submission
     * based on declared `_action` variable
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
    /**
     * generateRawJson function
     * used to generate raw json for submission 
     * which dynamically loop unindexed array 
     * from serializeArray function
     */
    function generateRawJson(UnindexedArray) {
        var IndexedArray = {};
        $.map(UnindexedArray, function(n, i){
            IndexedArray[n['name']] = n['value'];
        });
        return IndexedArray;
    }
    /**
     * parseErrorToHtml function
     * used to parse error retrieved from web service
     * and append it dynamically based on input name 
     */
    function parseErrorToHtml(error) {
        $.each(error, function(key, val) {
            var errValue = '<div id="errorContainer" style="color:red;font-size:9pt;">'+val+'</div>';
            $("#formContainer input[name='"+key+"']").next().html(errValue);
        });
    }
    /**
     * generateEditForm function
     * this function used to create edit form 
     * by getting data with ajax call 
     * and append them to form inside modal
     */
    function generateEditForm(id){
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Authorization': common.ajaxApiToken,
            },
            url: common.ajaxIdUrl+id,
            method: 'GET',
        }).success(function(data){
            // create hidden input id
            var idInput = '<input type="hidden" name="id" value="'+id+'">';
            // append hidden to modal form
            $('#appendContainer').append(idInput);
            // this function will parse data & append it to the modal form
            parseDataToHtml(data.data);
        });
    }
    /**
     * parseDataToHtml function
     * used to parse data which used to edit 
     * and append them to html form
     */
    function parseDataToHtml(data) {
        $.each(data, function(key, val) {
            $("#formContainer input[name='"+key+"']").val(val);
        });
    }
    /**
     * confirmWithModal function
     * appending data from message to modal confirm
     * and also open the modal
     */
    function confirmWithModal(message){
        $("#modalConfirm .modal-body").html(message);
        $("#modalConfirm").modal('toggle');
    }
    /**
     * deleteData function
     * used to delete data using ajax with method Delete
     * and reload the data if succeed
     */
    function deleteData(id){
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Authorization': common.ajaxApiToken,
            },
            url: common.ajaxIdUrl+id,
            method: 'DELETE',
        }).success(function(data){
            // success handler
            console.log("Delete Succeed!");
            // reload data
            reload();
            // send notification
            // .... not implemented yet ...
        });
        return true;
    }
});