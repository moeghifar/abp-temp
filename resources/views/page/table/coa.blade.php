@extends('index')
@section('title', 'Chart of Accounts')
@section('page_title', 'Chart of Accounts')
@section('user_name', 'Administrator')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <table id="datatable-custom-table" data-paging="false" class="table table-striped table-bordered dt-responsive no-sort" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="number-order">#</th>
                        <th width="5%">Group</th>
                        {{-- <th width="10%">Number of Accounts</th> --}}
                        <th>Name of Accounts</th>
                        <th width="5%">Debit</th>
                        <th width="5%">Credit</th>
                        <th width="5%">Balance</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- End Row -->
@endsection
@push('custom_js')
    <script>
        var mandatory = ["apiToken","urlGet","outputColumn"];
        var common = {};
        common.apiToken     = 'Bearer 7f9d683f2ec94ab9614ff204ac2be5591d7c84a3710895c0c477d3bb9f3ef2d93b3562ec94b2f0859c2e9122a70845da1d26193f2bb10f7743ddd0338394ea69';
        common.urlGet       = '/api/v1/table/coa/get'; 
        common.outputColumn = ["result_order","number_of_accounts","name_of_accounts","debit","credit","balance"];
    </script>
    <script src="/assets/customjs/main.js"></script>
@endpush