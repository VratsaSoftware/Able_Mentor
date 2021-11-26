@extends('layouts.app')

@section('title', 'Ученици - Able Mentor')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            <div class="row">
                <div class="col">
                    Ученици
                </div>
                <div class="col-2">
                    @include('includes.import-file', [
                        'routeName' => 'students-import',
                    ])
                </div>
            </div>
        </h1>
    </div>
    <div class="panel-body mt-5">
        <div class="responsive-datatable">
            <table class="table datatable table-striped table-bordered nowrap" style="border:1px; width: 100%">
                <thead>
                     <tr>
                         <th>Регистриран</th>
                         <th>Име</th>
                         <th>Email</th>
                         <th>Телефон</th>
                         <th>Пол</th>
                         <th>Град</th>
                         <th>Възраст</th>
                         <th>Училище</th>
                         <th>Клас</th>
                         <th>Любими предмети</th>
                         <th>Интереси</th>
                         <th>Ниво на АЕ</th>
                         <th>Спорт</th>
                         <th>Планове след гимназията</th>
                         <th>В кои сфери имаш силен интерес да се развиваш и в кои по-слаб?</th>
                         <th>Кои свои качества искаш да промениш/подобриш?</th>
                         <th>Как се забавляваш в свободното си време?</th>
                         <th>Разкажи ни за трудна ситуация/проблем и как си се справил/а?</th>
                         <th>Каква идея искаш да осъществиш в рамките на ABLE Mentor? Разкажи ни</th>
                         <th>Желая да променя</th>
                         <th>Средно по колко часа седмично би отделял/а на проекта?</th>
                         <th>По какъв проект би работил/а със своя ментор?</th>
                         <th>Откъде разбрахте за програмата ABLE Mentor?</th>
                     </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->created_at }}</td>
                            <td>
                                <a href="{{ route('student.show', $student->id) }}">{{ $student->name }}</a>
                                <div style="float: right">
                                    <a href="{{ route('students.connect', $student->id) }}" class="btn btn-success">
                                        @if ($student->mentors->count() == 0)
                                            <img src="{{ asset('img/user-connection-317.svg') }}" width="24px">
                                        @else
                                            <i class="fa fa-user"></i>
                                        @endif
                                    </a>
                                    @if (Auth::user()->isAdmin())
                                        <a href="{{ route('students-edit', $student->id) }}" class="btn btn-warning">
                                            <i class="fa fa-user-edit"></i>
                                        </a>
                                        @if ($student->mentors->count() == 0)
                                            <form id="deleteStudent-{{ $loop->iteration }}" style="display:inline-block;" action="{{ route('students-destroy', $student->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <span onclick="deleteStudent('deleteStudent-{{ $loop->iteration }}')" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->gender->gender }}</td>
                            <td>{{ $student->city ? $student->city->name : null }}</td>
                            <td>{{ $student->age }}</td>
                            <td>{{ $student->school }}</td>
                            <td>{{ $student->schoolClass->class_name }}</td>
                            <td>{{ $student->favorite_subjects }}</td>
                            <td>{{ $student->hobbies }}</td>
                            <td>{{ $student->englishLevel->level }}</td>
                            <td>{{ $student->sport->name }}</td>
                            <td>{{ $student->after_school_plans }}</td>
                            <td>{{ $student->strong_weak_sides }}</td>
                            <td>{{ $student->qualities_to_change }}</td>
                            <td>{{ $student->free_time_activities }}</td>
                            <td>{{ $student->difficult_situations }}</td>
                            <td>{{ $student->program_achievments }}</td>
                            <td>{{ $student->want_to_change }}</td>
                            <td>{{ $student->hours == 5 ? 'Повече' : $student->hours }}</td>
                            <td>
                                <ul>
                                    @foreach($student->projectTypes as $projectType)
                                        <li>
                                            {{ $projectType->type }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $student->able_mentor_info_source }}</td>
                        </tr>
                      @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Регистриран</th>
                        <th>Име</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Пол</th>
                        <th>Град</th>
                        <th>Възраст</th>
                        <th>Училище</th>
                        <th>Клас</th>
                        <th>Любими предмети</th>
                        <th>Интереси</th>
                        <th>Ниво на АЕ</th>
                        <th>Спорт</th>
                        <th>Планове след гимназията</th>
                        <th>В кои сфери имаш силен интерес да се развиваш и в кои по-слаб?</th>
                        <th>Кои свои качества искаш да промениш/подобриш?</th>
                        <th>Как се забавляваш в свободното си време?</th>
                        <th>Разкажи ни за трудна ситуация/проблем и как си се справил/а?</th>
                        <th>Каква идея искаш да осъществиш в рамките на ABLE Mentor? Разкажи ни</th>
                        <th>Желая да променя</th>
                        <th>Средно по колко часа седмично би отделял/а на проекта?</th>
                        <th>По какъв проект би работил/а със своя ментор?</th>
                        <th>Откъде разбрахте за програмата ABLE Mentor?</th>
                    </tr>
                </tfoot>
            </table>
        </div>
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
