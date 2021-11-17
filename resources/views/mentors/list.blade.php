@extends('layouts.app')

@push('page_css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@section('title')
Списък с всички ментори - Able Mentor
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Списък с всички ментори!</h1>
    </div>
    <div class="panel-body">
    	<table class="table" id="datatable">
    		<thead>
                 <tr>
                    <th>Име</th>
                    <th>Град</th>
                    <th>...</th>
                    <th>...</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
            	@foreach($mentors as $mentor)
            	  	<tr>
                        <td>
                            {{ $mentor['name'] }}
                        </td>
                        <td>
                            {{ $mentor['city']['name'] }}
                        </td>
                        <td>
                            <a href="{{ route('mentors-show', $mentor['id']) }}">Виж повече</a>
                        </td>
                        <td>
                            <a href="{{ route('mentors-connect', $mentor['id']) }}">Свържи със студент</a>
                        </td>
                        <td>
                        	<a href="{{ route('mentors-delete', $mentor['id']) }}">Изтрий</a>
                        </td>
            	  	</tr>
            	  @endforeach
            </tbody>
            <tfoot>
            	<tr>
                    <th>Име</th>
                    <th>Град</th>
                    <th>...</th>
                    <th>...</th>
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
@endpush
