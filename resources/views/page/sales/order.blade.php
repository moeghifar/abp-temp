@extends('index')
{{-- component content --}}
@section('title', 'Sales Order')
@section('page_title', 'Sales Order Data')
@section('user_name', 'Administrator')
{{-- main content --}}
@section('content')
    <p>Displaying Sales Order data.</p>
    <p>Action passed : {{ $action }}</p>
@endsection