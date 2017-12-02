@extends('index')
{{-- View data page : List all data --}}
@if($page == "view" && $id == null)
    @section('title', 'Customers Accounts')
    @section('page_title', 'Customers Accounts')
    @section('user_name', 'Administrator')
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="m-b-30 m-t-0">
                            <a href="/accounting/customers_accounts/add" class="btn btn-success waves-effect waves-light" ><i class="mdi mdi-plus"></i> Add Customers Accounts Records</a>
                        </div>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="number-order">#</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th class="action">Action</th>
                            </tr>
                            </thead>
                            <tbody>
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
                            <label for="input2">Customer Name</label>
                            <select name="customer_id" class="form-control"></select>
                            <small></small>
                        </div> 
                        <div class="form-group">
                            <label>Payment Date</label>
                            <div>
                                <div class="input-group">
                                    <input type="text" name="date" class="form-control" placeholder="Purchase Date" id="datepicker-autoclose" required>
                                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input2">Payment Status</label>
                            <select name="customer_id" class="form-control">
                                <option>-- paymeny status --</option>
                                <option>Paid</option>
                                <option>Unpaid</option>
                            </select>
                            <small></small>
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