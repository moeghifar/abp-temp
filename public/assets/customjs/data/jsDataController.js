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
            url: common.urlGet,
            method: 'GET',
        }).done(function(getData){
            console.log(getData.data);
            var jsonData = buildData(getData.data);
            var jsonCol = buildColumn(common.outputColumn);
            renderTable(jsonData, jsonCol);
        });
    }
    /**
     * buildData function
     * used to build data by embedding necessary data parameters such result_order & result_action 
     */
    function buildData(jData){
        for(lp = 0; lp < jData.length; lp++){
            var actionWrapper = "<span data-id='"+jData[lp][common.idName+"_id"]+"'>"+common.actionButton+"</span>";
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
            bSort           : false,
            deferLoading    : 2,
            data            : jsonData,
            columns         : jsonCol
        });
    }   
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
            ajaxUri = common.urlAdd;
            notif = "Add data succeed!";
        } else if (action == 'edit') {
            ajaxMethod = 'PUT';
            ajaxUri = common.urlID+id;
            notif = "Edit data succeed!";
        } else {
            alert('Wrong action type!');
        }
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Content-Type' : 'application/json',
                'Authorization': common.apiToken,
            },
            data: JSON.stringify(submitedData),
            url: ajaxUri,
            method: ajaxMethod,
        }).error(function(data){
            // handle error
            console.log("Error Occured!");
            // parse error and append to html
            parseErrorToHtml(data.responseJSON);
            // var fixError = parseErrorToHtml(data.responseJSON);
            // $("#errorContainer").html(fixError);
        }).success(function(data){
            // success handler
            console.log("OK Succeed!");
            // close dialog
            $('#modalForm').modal('hide');
            // reload data
            reload();
            // send notification
            notifSA(notif);
        });
        e.preventDefault();
        return false;
    });
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
            } else {
                // execute auto select generator if exist
                selectGenerator(action);
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
            // do delete by calling confirmWithModal function 
            confirmDeleteSA(getId);
        } else {
            // last condition detect if the action is malformed
            alert('Wrong action type!');
        }
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
        return $.ajax({
            headers : {
                'Accept': 'application/json',
                'Authorization': common.apiToken,
            },
            url: common.urlID+id,
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
        console.log("[LOG] execute parseDataToHtml");
        $.each(data, function(key, val) {
            var selectObject = {};
            if ($('#formContainer select[name="' + key + '"]').length) {
                console.log('generate select for : '+key +' = '+ val);
                // execute auto select generator if exist
                selectObject.key = key; 
                selectObject.value = val; 
                selectGenerator('edit',selectObject);  
            } 
            $("#formContainer input[name='" + key + "']").val(val);
        });
        return 
    }
    /**
     * confirmDeleteSA function
     * confirm deleting data with sweet alert confirm dialog
     * send id and message
     */
    function confirmDeleteSA(id){
        // new function using sweet alert confirm
        swal({
            title: 'Are you sure?',
            text: 'Your data will be deleted, if you proceed this confirmation!',
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-primary',
            confirmButtonText: "Yes",
            closeOnConfirm: false
        }, function () {
            deleteData(id);
        });
    }
    /**
     * deleteData function
     * used to delete data using ajax with method Delete
     * and reload the data if succeed
     */
    function deleteData(id){
        var notif = "Delete data succeed!";
        $.ajax({
            headers : {
                'Accept': 'application/json',
                'Authorization': common.apiToken,
            },
            url: common.urlID+id,
            method: 'DELETE',
        }).success(function(data){
            // success handler
            console.log("Delete Succeed!");
            // reload data
            reload();
            // notification
            swal("Deleted!", "Your data has been deleted.", "success");
        });
        return true;
    }
    /**
     * Automated `Select-Generator`
     */
    function selectGenerator(action,selectObject) {
        console.log("[LOG] execute selectGenerator [action : " + action + "]");
        if (action == 'edit') {

        } else {
            $('body').find('select').each(function () {
                var t = $(this);
                var check = t.data('generate');
                if (check == 'select-generator') {
                    var ajaxURI = t.data('api');
                    var idName = t.data('idname');
                    var selectData = '';
                    if (action == 'edit') {
                        var idSelect = t.data('idvalue');
                        console.log("idSelect :" + idSelect);
                    }
                    t.html();
                    selectGeneratorAjaxCall(ajaxURI, idName);   
                }
            });
        }
        
    }
    function selectGeneratorAjaxCall(t) {
        // get data with ajax
        return $.ajax({
            headers: {
                'Accept': 'application/json',
                'Authorization': common.apiToken,
            },
            url: ajaxURI,
            method: 'GET',
        }).success(function (getData) {
            if (typeof idSelect != 'undefined') {
                selectData = selectGeneratorDataBuilder(getData.data, idName, idSelect);
            } else {
                defaultSelectData = '<option value="0">... choose ' + idName + ' data ...</option>';
                selectData = defaultSelectData + selectGeneratorDataBuilder(getData.data, idName, null);
            }
            t.html(selectData);
        });
    }
    /**
     * Build data for `Select-Generator`
     */
    function selectGeneratorDataBuilder(jData,idName,idSelected){
        console.log("[LOG] execute selecGeneratorDataBuilder [idName]"+ idName +" [idSelected]"+ idSelected);
        selectData = [];
        for(lp = 0; lp < jData.length; lp++){
            var selected = '';
            var dataId = jData[lp][idName + "_id"];
            var dataName = jData[lp][idName + "_name"];
            if (idSelected != null) {
                if (idSelected == dataId) {
                    selected = 'selected="selected"';
                }
            }
            var optBuild = '<option value="'
                + dataId + '" '
                + selected + '>'
                + dataName + '</option>'
                ;
            selectData.push(optBuild);    
        }
        return selectData.join('');
    }
});