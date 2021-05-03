@extends('layouts.app')

@push('page_css')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Списък с всички студенти!</h1>
    </div>
    <div class="panel-body">
    	<table class="table" id="datatable">
    		<thead>
                 <tr>                   
                    <th>First Name</th>
                    <th>Second Name</th>
                    <th>City</th>
                    <th>Class</th>
                    <th>...</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
            	@foreach($students as $student)  
            	  	<tr>            	  		
                        <td>
                            {{ $student['name'] }}
                        </td>
                        <td>
                            {{ $student['name_second'] }}
                        </td>
                        <td>
                            {{ $student['city'][0]['name'] }}
                        </td>
                        <td>
                            {{ $student['class_id'] }}
                        </td>
                        <td>
                            <a href="{{ route('students-show', $student['id']) }}">Виж повече</a>                        	
                        </td>                       
                        <td>
                        	<a href="{{ route('students-delete', $student['id']) }}">Изтрий</a>
                        </td>
            	  	</tr> 
            	  @endforeach
            </tbody>  
            <tfoot>
            	<tr>                  
                    <th>First Name</th>
                    <th>Second Name</th>
                    <th>City</th>
                    <th>Class</th>
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