@extends('layouts.app')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('title', 'Свържи ' . $student->name . ' с ментор - Able Mentor')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Ментори на {{ $student->name }}</h1>
    </div>
    @if ($student->mentors->count())
        <h3 class="mt-5 text-center">
            {{ $student->mentors->first()->name }}

            <form style="display:inline-block; margin-left: 10px" action="{{ route('student-mentor.detach', ['student' => $student->id, 'mentor' => $student->mentors->first()->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <button class="btn btn-danger" onclick="return confirm('Връзката ще бъде премахната!')"><i class="fas fa-user-times"></i></button>
            </form>
        </h3>
    @endif
    <div style="margin-top: 30px;"></div>
    @if($appropriateMentors->count())
        <div class="panel-body">
            <h3>Ментори от същия тип</h3>
            @include('students.partials.mentors-table', [
                'mentors' => $appropriateMentors,
                'type' => 'appropriate',
            ])
        </div>
    @endif
    <div style="margin-top: 50px;"></div>
    <div class="panel-body">
        <h3>Други ментори</h3>
        @include('students.partials.mentors-table', [
            'mentors' => $otherMentors,
            'type' => 'other',
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
