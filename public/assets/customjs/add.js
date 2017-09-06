$(document).ready(function(){
    selectGenerator('add');
    /**
     * Submit form event listener
     * this submit listener will execute form submission
     * based on declared `_action` variable
     */
    $("body").on("submit", "#formContainer", function(e){
        var serializedInput = $(this).serializeArray();
        // console.log(JSON.stringify(serializedInput));
        var getMultiple = $('#formContainer [name="multiple"]').val();
        var multiple = getMultiple.split(",");
        console.log(multiple);
        var submitedData = generateRawJson(serializedInput,multiple);
        var action = submitedData._action;
        var id = submitedData.id;
        var ajaxUri, ajaxMethod;
        console.log(JSON.stringify(submitedData));
        // if (action == 'add') {
        //     ajaxMethod = 'POST';
        //     ajaxUri = common.urlAdd;
        //     notif = "Add data succeed!";
        // } else if (action == 'edit') {
        //     ajaxMethod = 'PUT';
        //     ajaxUri = common.urlID+id;
        //     notif = "Edit data succeed!";
        // } else {
        //     alert('Wrong action type!');
        // }
        // $.ajax({
        //     headers : {
        //         'Accept': 'application/json',
        //         'Content-Type' : 'application/json',
        //         'Authorization': common.apiToken,
        //     },
        //     data: JSON.stringify(submitedData),
        //     url: ajaxUri,
        //     method: ajaxMethod,
        // }).error(function(data){
        //     // handle error
        //     console.log("Error Occured!");
        //     // parse error and append to html
        //     parseErrorToHtml(data.responseJSON);
        //     // var fixError = parseErrorToHtml(data.responseJSON);
        //     // $("#errorContainer").html(fixError);
        // }).success(function(data){
        //     // success handler
        //     console.log("OK Succeed!");
        //     // close dialog
        //     $('#modalForm').modal('hide');
        //     // reload data
        //     reload();
        //     // send notification
        //     notifSA(notif);
        // });
        e.preventDefault();
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
    function generateRawJson(UnindexedArray,multiple) {
        var obj1 = { };
        var obj2 = { };
        var arr1 = [];
        var ptr = 1;
        $.map(UnindexedArray, function (n, i) {
            if (multiple.indexOf(n['name']) < 0) {
                obj1[n['name']] = cleanCurrency(n['value']);
            } else {
                if (ptr < multiple.length) {
                    obj2[n['name']] = cleanCurrency(n['value']);
                    ptr++;
                } else {
                    obj2[n['name']] = cleanCurrency(n['value']);
                    arr1.push(obj2);
                    obj2 = { };
                    ptr = 1;
                }
            }
            if(i == (UnindexedArray.length - 1)) {
                obj1['multi'] = arr1;
            }
        });
        return obj1;
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
        var ajaxURI = t.data('api')+'get';
        var idName = t.data('idname');
        var selectData = '';
        t.html();
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
            + '<div class="col-md-1" >'
            + '<div class="form-group">'
            + '<a data-delete="#' + buildIdElem + '" class="btn btn-md btn-danger deleteDuplicate" style="margin-top:25px;"><i class="fa fa-remove"></i></a>'
            + '<small></small>'
            + '</div>'
            + '</div>';
        var wrapDuplicated = ''
            + '<div class="row" id="' + buildIdElem + '">'
            + btnRemove
            + toDuplicate
            + '</div>'
            ;
        $('#'+dataDuplicate).parents('.duplicator').append(wrapDuplicated);
        duplicateCounter++;
        // console.log(wrapDuplicated);
    });
    /**
     * Delete duplicator function
     */
    $('body').on('click', '.duplicator .deleteDuplicate', function () {
        var dataDelete = $(this).data('delete');
        $(dataDelete).remove();
    });
    /**
     * get-live-data
     */
    $('body').on('change','.get-live-data',function(){
        var t = $(this);
        var ajaxURI = t.data('api') + t.val();
        var idName = t.data('idname');
        var dataGroup = t.parents('.row').attr('id');
        // get data with ajax
        return $.ajax({
            headers: {
                'Accept': 'application/json',
                'Authorization': common.apiToken,
            },
            url: ajaxURI,
            method: 'GET',
        }).success(function (getData) {
            bindLiveData('build-sales-order',dataGroup ,getData.data);
        });
    });
    $('body').on('keyup', '.qty', function () {
        var dataGroup = $(this).parents('.row').attr('id');
        // check price value
        var getPrice = $('#' + dataGroup + ' .price').val();
        var price = cleanCurrency(getPrice);
        if (price > 0){
            var qty = $(this).val();
            var qtyPrice = 0;
            if (price != "") {
                qtyPrice = qty * parseInt(price);
            }
            $('#' + dataGroup + ' .qty_price').val(nyastUtil.numberFormat(qtyPrice, 'Rp '));
        }
    });
    /**
     * Custom build declaration
     */
    function bindLiveData(option, dataGroup, rData) {
        if (option == 'build-sales-order') {
            var qty = $('#' + dataGroup + ' .qty').val();
            var qtyPrice = 0;
            if (qty > 0) {
                qtyPrice = qty * rData['price'];
            }
            $('#' + dataGroup + ' .price').val(nyastUtil.numberFormat(rData['price'], 'Rp '));
            $('#' + dataGroup + ' .qty_price').val(nyastUtil.numberFormat(qtyPrice, 'Rp '));
        }
    }
    /**
     * Clean from currency
     */
    function cleanCurrency(money) {
        if (money.startsWith('Rp ')) {
            return money.replace(/\./g, '').replace('Rp ', '').trim();
        } else {
            return money;
        }
    }
});