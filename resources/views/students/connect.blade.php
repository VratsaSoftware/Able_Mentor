@extends('layouts.app')

@push('head')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@section('title')
{{ __('Свържи ' . $student->name . ' ' . $student->name_second . ' с ментор - Able Mentor') }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Списък с подходящи ментори') }}</h1>
    </div>
    <div style="margin-top: 30px;"></div>
    <div class="panel-body">
        <h3>Ментори от същия тип</h3>
        <table class="table" id="datatableType">
            <thead>
                 <tr>
                    <th>Име</th>
                    <th>Фамилия</th>
                    <th>Град</th>
                    <th>Брой студенти</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                @php
                    echo $tableCodeType;
                @endphp
            </tbody>
            <tfoot>
                <tr>
                    <th>Име</th>
                    <th>Фамилия</th>
                    <th>Град</th>
                    <th>Брой студенти</th>
                    <th>...</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div style="margin-top: 50px;"></div>
    <div class="panel-body">
        <h3>Всички ментори</h3>
        <table class="table" id="datatable">
            <thead>
                 <tr>
                    <th>Име</th>
                    <th>Фамилия</th>
                    <th>Град</th>
                    <th>Брой студенти</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                @php
                    echo $tableCode;
                @endphp
            </tbody>
            <tfoot>
                <tr>
                    <th>Име</th>
                    <th>Фамилия</th>
                    <th>Град</th>
                    <th>Брой студенти</th>
                    <th>...</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
    <script>
        $(document).ready( function () {
            $('#datatableType').DataTable();
        });
    </script>
@endpush
