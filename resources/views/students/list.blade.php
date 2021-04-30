@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">List with all students!</h1>
    </div>
    <div class="panel-body">
    	<table class="table" id="datatable">
    		<thead>
                 <tr>
                    <th>#</th>
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
                                            
                        </td>
                        <td>
                            {{ $student['name'] }}
                        </td>
                        <td>
                            {{ $student['name_second'] }}
                        </td>
                        <td>
                            {{ $student['city_id'] }}
                        </td>
                        <td>
                            {{ $student['class_id'] }}
                        </td>
                        <td>
                        	View More
                        </td>                       
                        <td>
                        	Delete
                        </td>
            	  	</tr> 
            	  @endforeach
            </tbody>  
            <tfoot>
            	<tr>
                    <th>#</th>
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

@section('javascripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
      
        $(document).ready(function() {            
            var t = $('#datatable').DataTable( {    
                "paging": false, 
                "searching": false, 
                "info": false, 
                "aoColumnDefs": [
                    {
                        orderSequence: ["desc", "asc"],
                        aTargets: ['_all']
                    }
                ],                         
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 1, 'asc' ]]
            } );
         
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        } );
    </script>
@endsection