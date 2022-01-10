@extends('layouts.app')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('title', 'Свържи ' . $mentor->name . ' със студент - Able Mentor')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Списък с всички ученици ({{ $mentor->students->count() }})</h1>
    </div>
    <div style="margin-top: 30px;"></div>
    <div class="panel-body">
        <h3>Ученици от същия тип</h3>
        @include('mentors.partials.students-table', [
            'students' => $appropriateStudents,
            'type' => 'appropriate',
        ])
    </div>
    <div style="margin-top: 50px;"></div>
    <div class="panel-body">
    <h3>Други ученици</h3>
        @include('mentors.partials.students-table', [
            'students' => $otherStudents,
            'type' => 'other',
        ])
    </div>
@endsection

@push('scripts')
    @include('includes.datatable-scripts')
@endpush
