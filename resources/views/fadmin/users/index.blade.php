@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    {{-- Setup data for datatables --}}
    {{-- @section('plugins.Datatables', true)
    @section('plugins.DatatablesPlugin', false) --}}

    @php
    $heads = [
        'ID',
        'Name',
        ['label' => 'Email', 'width' => 40],
        ['label' => 'Actions', 'no-export' => true, 'width' => 5],
    ];
    // $config['paging'] = true;
    // $config['pageLength'] = 5;
    // :config="$config"
    @endphp
    
    {{-- Minimal example / fill data using the component slot --}}
    <div class="card"> 
        {{-- <div class="card-header">
            <h3 class="card-title">
                DataTable with default features
            </h3>
        </div> --}}
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" triped hoverable with-buttons >
                @foreach($data as $key => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <nobr>
                                <a class="btn btn-xs btn-default text-primary mx-1 shadow" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                                <a class="btn btn-xs btn-default text-danger mx-1 shadow" href="#"><i class="fa fa-lg fa-fw fa-trash"></i></a>
                                <a class="btn btn-xs btn-default text-teal mx-1 shadow" href="#"><i class="fa fa-lg fa-fw fa-eye"></i></a>
                            </nobr>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>

    {{-- With buttons --}}
    {{-- <x-adminlte-datatable id="table1" :heads="$heads" :config="$config"
    striped hoverable with-buttons/> --}}


@stop

{{-- 添加footer --}}
@include('fadmin.include._footer')

{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@section('js')
    <script> console.log('Hi!'); </script>
@stop