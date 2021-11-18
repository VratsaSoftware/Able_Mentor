@extends('layouts.app')

@section('title', 'Студенти - Able Mentor')

@push('head')
    @include('includes.datatable-head')
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
    @include('includes.datatable-scripts')
@endpush
