@extends('layouts/main')
@section('title', 'Welcome')
@section('content')
<div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li class="active">
                <i class="ace-icon fa fa-dashboard home-icon"></i>
                <a href="{{ url('') }}">Dashboard</a>
            </li>

            <li class="active">Item Transaction</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Item</th>
                            <th>Customer</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Description</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div><!-- /.page-content -->
</div>
@endsection

@section('script')
$(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('histories.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'history_date', name: 'tanggal'},
            {data: 'itemname', name: 'itemname'},
            {data: 'name', name: 'customername'},
            {data: 'qty', name: 'qty'},
            {data: 'price', name: 'price'},
            {data: 'totalprice', name: 'totalprice'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });   
  });
@endsection