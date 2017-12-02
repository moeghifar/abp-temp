@extends('index')
{{-- View data page : List all data --}}
@if($page == "view" && $id == null)
    @section('title', 'Journal')
    @section('page_title', 'Journal')
    @section('user_name', 'Administrator')
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs navtab-bg">
                    <li class="active">
                        <a href="#sales" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-home"></i></span>
                            <span class="hidden-xs">Sales</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#purchase" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">Purchase</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#cash-receipt" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                            <span class="hidden-xs">Cash Receipt</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#cash-payment" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs">Cash Payment</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#memorial" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-cog"></i></span>
                            <span class="hidden-xs">Memorial</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="sales">
                        <h4>Sales Journal</h4>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%">
                        {{-- <table class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%"> --}}
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Sales Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Ref</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2017-11-12</td>
                                    <td>SINV-0001</td>
                                    <td>Christiano Ronaldo</td>
                                    <td>v</td>
                                    <td>3.500.000</td>
                                    <td>3.500.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="purchase">
                        <h4>Purchase Journal</h4>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%">
                        {{-- <table class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%"> --}}
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Sales Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Ref</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2017-11-12</td>
                                    <td>SINV-0001</td>
                                    <td>Christiano Ronaldo</td>
                                    <td>v</td>
                                    <td>3.500.000</td>
                                    <td>3.500.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="cash-receipt">
                        <h4>Cash Receipt Journal</h4>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%">
                        {{-- <table class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%"> --}}
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Sales Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Ref</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2017-11-12</td>
                                    <td>SINV-0001</td>
                                    <td>Christiano Ronaldo</td>
                                    <td>v</td>
                                    <td>3.500.000</td>
                                    <td>3.500.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="cash-payment">
                        <h4>Cash Payment Journal</h4>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%">
                        {{-- <table class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%"> --}}
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Sales Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Ref</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2017-11-12</td>
                                    <td>SINV-0001</td>
                                    <td>Christiano Ronaldo</td>
                                    <td>v</td>
                                    <td>3.500.000</td>
                                    <td>3.500.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="memorial">
                        <h4>Memorial Journal</h4>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%">
                        {{-- <table class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%"> --}}
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Sales Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Ref</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2017-11-12</td>
                                    <td>SINV-0001</td>
                                    <td>Christiano Ronaldo</td>
                                    <td>v</td>
                                    <td>3.500.000</td>
                                    <td>3.500.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
        <!-- BOF Modal with confirmation -->
        <div id="modalConfirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button id="btnYes" type="button" class="btn btn-primary waves-effect waves-light">Yes</button>
                        <button id="btnCancel" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>    
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- EOF Modal with confirmation -->
    @endsection
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
            common.actionButton = '<button id="btnAction" data-action="view" style="margin-bottom:5px;" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></button>&nbsp;<button id="btnAction" data-action="delete" style="margin-bottom:5px;" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
        </script>
        <script src="/assets/customjs/main.js"></script>
    @endpush
@elseif($page == "view" && $id != null)
    @section('title', 'Detail Sales Order')
    @section('page_title', 'Detail Sales Order')
    @section('user_name', 'Administrator')
    @section('content')
        <div class="row">
            <div class="col-md-12" id="table-container">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12" >
                                <h4 class="alert alert-info">Sales Order</h4>
                                <table class="table table-bordered" id="sales_order_data">
                                </table>
                            </div> 
                            <div class="col-xs-12">
                                <h4 class="alert alert-info">Product Data</h4>
                                <table class="table table-hover" id="product_data">
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('custom_js')
        <script>
            var mandatory = ["idName","apiToken","urlID","sales_order_data"]
            var common = {};
            common.idName           = 'sales_order';
            common.apiToken         = 'Bearer 7f9d683f2ec94ab9614ff204ac2be5591d7c84a3710895c0c477d3bb9f3ef2d93b3562ec94b2f0859c2e9122a70845da1d26193f2bb10f7743ddd0338394ea69';
            common.urlID            = '/api/v1/sales/order/' + {{$id}};   
            common.sales_order_data = { "sales_number": "Sales Number", "date": "Sales Date", "total_price": "Total Price", "customer_data" : "Customer Data"};
            common.product_data     = { "product_name": "Product Name", "qty": "Quantity", "price": "Price", "qty_price" : "Total Price"};
        </script>
        <script src="/assets/customjs/view.js"></script>
    @endpush
{{-- Add data page : Add new / create data --}}
@elseif($page == "add")
    @section('title', 'Set Assets')
    @section('page_title', 'Set Assets')
    @section('user_name', 'Administrator')
    @section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <form id="formContainer">
                        <div class="form-group">
                            <label for="input1">Account Name</label>
                            <input type="text" class="form-control" name="sales_number" placeholder="Account Name" required>
                            <small></small>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="input2">Account Number</label>
                                    <select name="customer_id" class="form-control"></select>
                                    <small></small>
                                </div>             
                            </div> 
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div>
                                        <div class="input-group">
                                            <input type="text" name="date" class="form-control" placeholder="Date" id="datepicker-autoclose" required>
                                            <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input1">Balance</label>
                            <input type="text" class="form-control" name="sales_number" placeholder="Balance" required>
                        </div>
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
            var mandatory = ["idName","apiToken","urlAdd"]
            var common = {};
            common.idName       = 'sales_order';
            common.apiToken     = 'Bearer 7f9d683f2ec94ab9614ff204ac2be5591d7c84a3710895c0c477d3bb9f3ef2d93b3562ec94b2f0859c2e9122a70845da1d26193f2bb10f7743ddd0338394ea69';
            common.urlAdd       = '/api/v1/sales/order/add';  
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
@endif