@extends('layouts.app')

@push('page_css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@section('title')
{{ __('Свържи ' . $mentor->name . ' ' . $mentor->name_second . ' със студент - Able Mentor') }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Списък с всички студенти') }}</h1>
    </div>
    <div style="margin-top: 30px;"></div>
    <div class="panel-body">     
    <h3>Студенти от същия тип</h3>  	
        <table class="table" id="datatableType">
            <thead>
                 <tr>                   
                    <th>Име</th>
                    <th>Фамилия</th>
                    <th>Град</th>
                    <th>Клас</th>
                    <th>Брой ментори</th>
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
                    <th>Клас</th>
                    <th>Брой ментори</th>
                    <th>...</th>
                </tr>
            </tfoot>     
        </table>
    </div>
    <div style="margin-top: 50px;"></div>
    <div class="panel-body">     
    <h3>Всички студенти</h3>      
        <table class="table" id="datatable">
            <thead>
                 <tr>                   
                    <th>Име</th>
                    <th>Фамилия</th>
                    <th>Град</th>
                    <th>Клас</th>
                    <th>Брой ментори</th>
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
                    <th>Клас</th>
                    <th>Брой ментори</th>
                    <th>...</th>
                </tr>
            </tfoot>     
        </table>
    </div>
@endsection

@push('page_scripts')
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