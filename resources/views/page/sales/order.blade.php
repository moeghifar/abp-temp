@extends('index')
@section('title', 'Sales Order')
@section('page_title', 'Sales Order Data')
@section('user_name', 'Administrator')
@section('content')
    @if($sales_order_id == null)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="m-b-30 m-t-0">
                            <button id="btnAction" data-action="add" type="button" class="btn btn-success waves-effect waves-light" ><i class="mdi mdi-plus"></i> Add Sales Order</button>
                        </div>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sales Order</th>
                                <th>Product</th>
                                <th>Qty</th>
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
    @else
    Sales Order Id : {{ $sales_order_id }}
    @endif
    <!-- BOF modal with form -->
    <div id="modalForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Form Sales Order</h4>
                </div>
                <form id="formContainer">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="input1">Sales Order</label>
                                <input type="text" class="form-control" name="supplier_name" placeholder="Supplier Name">
                                <small></small>
                            </div>
                            <div class="form-group">
                                <label for="input2">Sales Order</label>
                                <input type="text" class="form-control" name="supplier_phone" placeholder="Supplier Phone">
                                <small></small>
                            </div>
                            <div class="form-group">
                                <label for="input3">Sales Order</label>
                                <input type="text" class="form-control" name="supplier_address" placeholder="Supplier Address">
                                <small></small>
                            </div>
                            <div id="appendContainer"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="save_data">Save changes</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>    
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- EOF modal with form -->
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
    <script>
        var mandatory = ["idName","apiToken","urlID","urlGet","urlAdd","outputColumn","actionButton"]
        var common = {};
        common.idName       = 'sales_order';
        common.apiToken     = 'Bearer 7f9d683f2ec94ab9614ff204ac2be5591d7c84a3710895c0c477d3bb9f3ef2d93b3562ec94b2f0859c2e9122a70845da1d26193f2bb10f7743ddd0338394ea69';
        common.urlID        = '/api/v1/sales/order/'; 
        common.urlGet       = '/api/v1/sales/order/get'; 
        common.urlAdd       = '/api/v1/sales/order/add';  
        common.outputColumn = ["result_order","sales_order_name","sales_order_phone","sales_order_address","result_action"];
        common.actionButton = '<button id="btnAction" data-action="edit" style="margin-bottom:5px;" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button> <button id="btnAction" data-action="delete" style="margin-bottom:5px;" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
    </script>
    <script src="/assets/customjs/main.js"></script>
@endpush