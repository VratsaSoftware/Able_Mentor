@extends('layouts.app')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('title', 'Свържи ' . $student->name . ' с ментор - Able Mentor')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Свързване с ментори</h1>
    </div>
    <div style="margin-top: 30px;"></div>
    <div class="panel-body">
        <h3>Ментори от същия тип</h3>
        @include('students.partials.mentor-table', [
            'mentors' => $appropriateMentors,
        ])
    </div>
    <div style="margin-top: 50px;"></div>
    <div class="panel-body">
        <h3>Други ментори</h3>
        @include('students.partials.mentor-table', [
            'mentors' => $otherMentors,
        ])
    </div>
@endsection

@push('scripts')
    @include('includes.datatable-scripts')

    <script>
        function deleteStudent(formId) {
            if (confirm('Студентът ще бъде изтрит!')) {
                $('#' + formId).submit();
            }
        }
    </script>
@endpush
