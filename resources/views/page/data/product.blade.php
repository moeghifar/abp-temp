@extends('index')
@section('title', 'Product')
@section('page_title', 'Product Data')
@section('user_name', 'Administrator')
@section('content')
    @if($product_id == null)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="m-b-30 m-t-0">
                            <button id="btnAction" data-action="add" type="button" class="btn btn-success waves-effect waves-light" ><i class="mdi mdi-plus"></i> Add Product</button>
                        </div>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Supplier</th>
                                <th>Price</th>
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
    Product Id : {{ $product_id }}
    @endif
    <!-- BOF modal with form -->
    <div id="modalForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Form Product</h4>
                </div>
                <form id="formContainer">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="input1">Product Name</label>
                                <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                                <small></small>
                            </div>
                            <div class="form-group">
                                <label for="input2">Supplier</label>
                                <select data-generate="select-generator" data-idname="supplier" data-api="/api/v1/supplier/get" name="supplier_id" class="form-control"></select>
                                <small></small>
                            </div>
                            <div class="form-group">
                                <label for="input3">Price</label>
                                <input type="text" class="form-control" name="price" placeholder="price">
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
        common.idName       = 'product';
        common.apiToken     = 'Bearer 7f9d683f2ec94ab9614ff204ac2be5591d7c84a3710895c0c477d3bb9f3ef2d93b3562ec94b2f0859c2e9122a70845da1d26193f2bb10f7743ddd0338394ea69';
        common.urlID        = '/api/v1/product/'; 
        common.urlGet       = '/api/v1/product/get'; 
        common.urlAdd       = '/api/v1/product/add';  
        common.outputColumn = ["result_order","product_name","supplier_name","price","result_action"];
        common.actionButton = '<button id="btnAction" data-action="edit" style="margin-bottom:5px;" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button> <button id="btnAction" data-action="delete" style="margin-bottom:5px;" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
    </script>
    <script src="/assets/customjs/data/jsDataController.js"></script>
@endpush