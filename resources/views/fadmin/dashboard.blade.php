@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    {{-- Setup data for datatables --}}
    {{-- @section('plugins.Datatables', true)
    @section('plugins.DatatablesPlugin', true) --}}
    
@stop

{{-- 添加footer --}}
@include('fadmin.include._footer')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop