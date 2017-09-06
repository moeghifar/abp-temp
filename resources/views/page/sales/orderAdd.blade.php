@extends('index')
@section('title', 'Create Sales Order')
@section('page_title', 'Add Sales Order Data')
@section('user_name', 'Administrator')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <form id="formContainer">

                    <div class="form-group">
                        <label for="input1">Sales Order Number</label>
                        <input type="text" class="form-control" name="sales_number" placeholder="Sales Order Number" required>
                        <small></small>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="input2">Customer</label>
                                <select data-generate="select-generator" data-idname="customer" data-api="/api/v1/customer/" name="customer_id" class="form-control"></select>
                                <small></small>
                            </div>             
                        </div> 
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Date</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" name="date" class="form-control" placeholder="Sales Order Date" id="datepicker-autoclose" required>
                                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="duplicator">
                        <div class="row" id="sales-product">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <a class="btn btn-md btn-success duplicate" data-duplicate="sales-product-duplicate" style="margin-top:25px;"><i class="fa fa-plus"></i></a>
                                    <small></small>
                                </div>
                            </div>
                            <span id="sales-product-duplicate">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="input2">Product Name</label>
                                        <select data-target="price" data-generate="select-generator" data-idname="product" data-api="/api/v1/product/" name="product_id" class="form-control get-live-data"></select>
                                        <small></small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="input3">Qty</label>
                                        <input type="text" pattern="[1-9][0-9]*" min="1" class="form-control qty" name="qty" placeholder="Quantity" value="1" required>
                                        <small></small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="input3">Price</label>
                                        <input type="text" class="form-control price" readonly>
                                        <small></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="input3">Qty * Price</label>
                                        <input type="text" class="form-control qty_price" name="qty_price" readonly >
                                        <small></small>
                                    </div>
                                </div>
                            </span>
                        </div>                            
                    </div>
                    <div id="appendContainer"></div>
                    <input type="hidden" name="multiple" value="product_id,qty,qty_price">
                    <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    <input class="btn btn-warning" type="reset" name="reset" value="Reset">
                </form>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div> <!-- End row -->
@endsection
@push('custom_css')
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        var mandatory = ["idName","apiToken","urlID","urlGet","urlAdd","outputColumn","actionButton"]
        var common = {};
        common.idName       = 'sales_order';
        common.apiToken     = 'Bearer 7f9d683f2ec94ab9614ff204ac2be5591d7c84a3710895c0c477d3bb9f3ef2d93b3562ec94b2f0859c2e9122a70845da1d26193f2bb10f7743ddd0338394ea69';
        common.urlID        = '/api/v1/sales/order/'; 
        common.urlGet       = '/api/v1/sales/order/get'; 
        common.urlAdd       = '/api/v1/sales/order/add';  
        common.outputColumn = ["result_order","sales_number","customer_name","date","price","result_action"];
        common.actionButton = '<button id="btnAction" data-action="edit" style="margin-bottom:5px;" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button> <button id="btnAction" data-action="delete" style="margin-bottom:5px;" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
        jQuery('#datepicker-autoclose').datepicker({
            startView: 'decade',
            format: 'yyyy-mm-dd',
            todayBtn: true,
            autoclose: true,
            todayHighlight: true
        });
    </script>
    <script src="/assets/customjs/add.js"></script>
@endpush