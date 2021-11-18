@extends('layouts.app')

@section('title', 'Студенти - Able Mentor')

@push('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Студенти</h1>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered nowrap" id="datatable" style="border:1px; width: 100%">
            <thead>
                 <tr>
                    <th>Име</th>
                    <th>Град</th>
                    <th>Клас</th>
                    <th>...</th>
                    <th>...</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>
                            {{ $student['city'][0]['name'] }}
                        </td>
                        <td>
                            {{ $student['class_id'] }}
                        </td>
                        <td>
                            <a href="{{ route('students-show', $student->id) }}">Виж повече</a>
                        </td>
                        <td>
                            <a href="{{ route('students-connect', $student->id) }}">Свържи с ментор</a>
                        </td>
                        <td>
                            <a href="{{ route('students-edit', $student->id) }}" class="btn btn-success">
                                <i class="fa fa-user-edit"></i>
                            </a>
                            <form style="display:inline-block; margin-left: 10px" action="{{ route('students-destroy', $student->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Студентът ще бъде изтрит!')" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                  @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Име</th>
                    <th>Град</th>
                    <th>Клас</th>
                    <th>...</th>
                    <th>...</th>
                    <th>...</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

    <script>
	    $(document).ready( function () {
	   		$('#datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Details for '+data[0]+' '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            });
		});
    </script>
@endpush
