@extends('index')
{{-- component parameter --}}
@section('title', 'Product')
@section('page_title', 'Product Data')
@section('user_name', 'Administrator')
{{-- main data parameter --}}
@section('content')
    @if($action == 'view')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h4 class="m-b-30 m-t-0">
                            <a href="" class="btn btn-success"><i class="mdi mdi-plus"></i> Add Product</a>
                        </h4>
                        <table id="datatable-custom-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Supplier</th>
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
    @endif
    @isset($product_id)
        <p>Product id exists : {{ $product_id }}</p>
    @endisset
@endsection
@push('custom_js')
    <script src="/assets/customjs/data/product.js"></script>
@endpush