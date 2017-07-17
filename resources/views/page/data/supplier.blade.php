@extends('index')
@section('title', 'Supplier')
@section('page_title', 'Supplier Data')
@section('user_name', 'Administrator')
@section('content')
    @if($action == 'view')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        {{-- <h4 class="m-b-30 m-t-0">
                            <a href="" class="btn btn-success"><i class="mdi mdi-plus"></i> Add Supplier</a>
                        </h4> --}}
                        <div class="m-b-30 m-t-0">
                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modalForm"><i class="mdi mdi-plus"></i> Add Supplier</button>
                        </div>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Supplier Name</th>
                                <th>Supplier Phone</th>
                                <th>Supplier Address</th>
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
    @endif
    @isset($supplier_id)
        <p>Product id exists : {{ $supplier_id }}</p>
    @endisset
    <div class="col-xs-6 col-sm-3 m-t-30">
        <!-- standard modal -->
        <div id="modalForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Form Input New Supplier</h4>
                    </div>
                    <form id="modal_form" method="POST">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="input1">Supplier Name</label>
                                    <input type="text" class="form-control" name="supplier_name" placeholder="Supplier Name">
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <label for="input2">Supplier Phone</label>
                                    <input type="text" class="form-control" name="supplier_phone" placeholder="Supplier Phone">
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <label for="input3">Supplier Address</label>
                                    <input type="text" class="form-control" name="supplier_address" placeholder="Supplier Address">
                                    <span></span>
                                </div>
                                <div id="errorContainer" class="form-group" style="color:red;font-size:9pt;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="save_data">Save changes</button>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>    
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection
@push('custom_js')
    <script>
        var mandatory = ["ajaxUrl","ajaxAction","ajaxOutputColumn","ajaxApiToken"]
        var common = {};
        common.ajaxApiToken = 'Bearer 7f9d683f2ec94ab9614ff204ac2be5591d7c84a3710895c0c477d3bb9f3ef2d93b3562ec94b2f0859c2e9122a70845da1d26193f2bb10f7743ddd0338394ea69';
        common.ajaxUrl = '/api/v1/supplier/get'; 
        common.ajaxSubmitUrl = '/api/v1/supplier/add'; 
        common.ajaxOutputColumn = ["result_order","supplier_name","supplier_phone","supplier_address","result_action"];
        common.ajaxAction = '<a id="doEdit" style="margin-bottom:5px;" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a> <a id="doDelete" style="margin-bottom:5px;" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
    </script>
    <script src="/assets/customjs/data/jsDataController.js"></script>
@endpush