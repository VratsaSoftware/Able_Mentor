@extends('layouts.app')

@section('title', 'Архив - Able Mentor')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="text-black-50">
                    Архив
                </h1>
            </div>
            <div class="col col-lg-2">
                <form method="get" action="{{ route('archive') }}" class="mt-3">
                    <select name="season" class="form-control" onchange="this.form.submit()">
                        @foreach($pastSeasons as $season)
                            <option value="{{ $season->id }}" {{ Request::get('season') == $season->id ? 'selected' : null }}>{{ $season->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="panel-body mt-5">
        <div class="responsive-datatable">
            <table class="table datatable table-striped table-bordered nowrap" style="border:1px; width: 100%">
                <thead>
                <tr>
                    <th>Ученик</th>
                    <th>Ментор</th>
                    <th>Съвпадимост</th>
                    <th>Проект</th>
                    <th>Часове за проекта</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td><a href="{{ route('student.show', $student->id) }}">{{ $student->name }}</a></td>
                            <td><a href="{{ route('mentor.show', $student->mentors->first()->id) }}">{{ $student->mentors->first()->name }}</a></td>
                            <td>{{ \App\Services\MentorStudentService::matchingCalculation($student, $student->mentors->first()) }}</td>
                            <td>
                                <ul>
                                    @foreach($student->projectTypes as $projectType)
                                        @if(in_array($projectType->id, $student->mentors->first()->projectTypes->pluck('id')->toArray()))
                                            <li>
                                                {{ $projectType->type }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                Ученик: {{ $student->hours }} /
                                Ментор: {{ $student->mentors->first()->hours }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Ученик</th>
                    <th>Ментор</th>
                    <th>Съвпадимост</th>
                    <th>Проект</th>
                    <th>Часове за проекта</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('includes.datatable-scripts')
@endpush
