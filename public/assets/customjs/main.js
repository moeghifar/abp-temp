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
    /**
     * Submit form event listener
     * this submit listener will execute form submission
     * based on declared `_action` variable
     */
    $("body").on("submit", "#formContainer", function(e){
        var serializedInput = $(this).serializeArray();
        console.log(serializedInput);
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
            console.log("Error Occured!");
            parseErrorToHtml(data.responseJSON);
        }).success(function(data){
            console.log("OK Succeed!");
            $('#modalForm').modal('hide');
            reload();
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
        var action = $(this).data('action');
        $('#formContainer input').val("");
        $("#formContainer #errorContainer").remove();
        if (action == 'add' || action == 'edit') { 
            if (action == 'edit') {
                var getId = $(this).parent().data('id');
                generateEditForm(getId);
            } else {
                selectGenerator(action);
            }
            var actionInput = '<input type="hidden" name="_action" value="'+action+'">';
            $('#appendContainer').html(actionInput);
            $("#modalForm").modal('toggle');
        } else if (action == 'delete')  {
            var getId = $(this).parent().data('id');
            console.log(getId);
            confirmDeleteSA(getId);
        } else if (action == 'view') {
            var getId = $(this).parent().data('id');
            window.location.href = window.location.href + "/" + getId;
        } else {
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
            var idInput = '<input type="hidden" name="id" value="'+id+'">';
            $('#appendContainer').append(idInput);
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
        $.each(data, function(className, itemID) {
            var selectObject = {};
            if ($('#formContainer select[name="' + className + '"]').length) {
                console.log('generate select for : ' + className +' = '+ itemID);
                selectObject.className = className; 
                selectObject.itemID = itemID; 
                selectGenerator('edit',selectObject);  
            } 
            $("#formContainer input[name='" + className + "']").val(itemID);
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
            console.log("Delete Succeed!");
            reload();
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
            $('body').find('select[name="'+ selectObject.className +'"]').each(function () {
                var t = $(this);
                var check = t.data('generate');
                if (check == 'select-generator') {
                    selectGeneratorAjaxCall(t, selectObject.itemID);
                }
            });
        } else {
            $('body').find('select').each(function () {
                var t = $(this);
                var check = t.data('generate');
                if (check == 'select-generator') {
                    selectGeneratorAjaxCall(t);   
                }
            });
        }
        
    }
    function selectGeneratorAjaxCall(t, idSelect) {
        var ajaxURI = t.data('api');
        var idName = t.data('idname');
        var selectData = '';
        t.html();
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
                defaultSelectData = '<option value="0">choose ' + idName + ' data . . .</option>';
                selectData = defaultSelectData + selectGeneratorDataBuilder(getData.data, idName, null);
            }
            t.html(selectData);
        });
    }
    /**
     * Build data for `Select-Generator`
     */
    function selectGeneratorDataBuilder(jData,idName,idSelected) {
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
    /**
     * Duplicator button listener
     */
    var duplicateCounter = 1;
    $('body').on('click', '.duplicator .duplicate', function () {
        var ini = $(this);
        var dataDuplicate = ini.data('duplicate');
        var toDuplicate = $('#'+dataDuplicate).html();
        var buildIdElem = dataDuplicate + '-' + duplicateCounter;
        var btnRemove = ''
            + '<div class="col-md-2" >'
            + '<div class="form-group">'
            + '<a data-delete="#' + buildIdElem + '" class="btn btn-md btn-danger deleteDuplicate" style="margin-top:25px;"><i class="fa fa-remove"></i></a>'
            + '<small></small>'
            + '</div>'
            + '</div>';
        var wrapDuplicated = ''
            + '<div class="row" id="' + buildIdElem + '">'
            + toDuplicate
            + btnRemove
            + '</div>'
            ;
        $('#'+dataDuplicate).parents('.duplicator').append(wrapDuplicated);
        duplicateCounter++;
    });
    /**
     * Delete duplicator function
     */
    $('body').on('click', '.duplicator .deleteDuplicate', function () {
        var dataDelete = $(this).data('delete');
        $(dataDelete).remove();
    });
});