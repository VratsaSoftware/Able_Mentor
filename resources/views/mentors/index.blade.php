@extends('layouts.app')

@section('title', 'Ментори - Able Mentor')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            <div class="row">
                <div class="col">
                    Ментори
                </div>
                <div class="col-2">
                    @include('includes.import-file', [
                        'routeName' => 'mentors-import',
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
                        <th>Възраст</th>
                        <th>Имейл</th>
                        <th>Телефон</th>
                        <th>Пол</th>
                        <th>Сезон в който си бил ментор</th>
                        <th>Град за участие</th>
                        <th>Образование</th>
                        <th>Месторабота</th>
                        <th>Професионален опит/интереси</th>
                        <th>Разкажете ни за Вашите интереси/хобита/компетенции, различни от професионалните Ви такива? Какъв е опитът Ви в тези сфери?</th>
                        <th>Разкажете ни за трудна ситуация/проблем и как сте се справили?</th>
                        <th>Желая да променя/подобря...</th>
                        <th>Средно по колко часа седмично би отделял/а на проекта?</th>
                        <th>По какъв проект бихте работили със своя ученик?</th>
                        <th>Автобиография</th>
                        <th>Откъде разбрахте за програмата ABLE Mentor?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mentors as $mentor)
                        <tr>
                            <td>{{ $mentor->created_at }}</td>
                            <td>
                                {{ $mentor->name }}
                                <div style="float: right">
                                    <a href="{{ route('mentors.connect', $mentor->id) }}" class="btn btn-success">
                                        <img src="{{ asset('img/user-connection-317.svg') }}" width="24px">
                                    </a>
                                    @if (Auth::user()->isAdmin())
                                        <a href="{{ route('mentors-edit', $mentor->id) }}" class="btn btn-warning">
                                            <i class="fa fa-user-edit"></i>
                                        </a>
                                        <form id="deleteMentor-{{ $loop->iteration }}" style="display:inline-block;" action="{{ route('mentors-destroy', $mentor->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <span onclick="deleteMentor('deleteMentor-{{ $loop->iteration }}')" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </form>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $mentor->age }}</td>
                            <td>{{ $mentor->email }}</td>
                            <td>{{ $mentor->phone }}</td>
                            <td>{{ $mentor->gender->gender }}</td>
                            <td>{{ $mentor->previousSeason->name }}</td>
                            <td>{{ $mentor->city->name }}</td>
                            <td>{{ $mentor->education }}</td>
                            <td>{{ $mentor->work }}</td>
                            <td>{{ $mentor->experience }}</td>
                            <td>{{ $mentor->expertise }}</td>
                            <td>{{ $mentor->difficult_situations }}</td>
                            <td>{{ $mentor->want_to_change }}</td>
                            <td>{{ $mentor->hours }}</td>
                            <td>
                                <ul>
                                    @foreach($mentor->projectTypes as $projectType)
                                        <li>
                                            {{ $projectType->type }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td><a href="{{ asset('cv/' . $mentor->cv_path) }}" download="{{ $mentor->name }}">Свали</a></td>
                            <td>{{ $mentor->able_mentor_info }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Регистриран</th>
                        <th>Име</th>
                        <th>Възраст</th>
                        <th>Имейл</th>
                        <th>Телефон</th>
                        <th>Пол</th>
                        <th>Сезон в който си бил ментор</th>
                        <th>Град за участие</th>
                        <th>Образование</th>
                        <th>Месторабота</th>
                        <th>Професионален опит/интереси</th>
                        <th>Разкажете ни за Вашите интереси/хобита/компетенции, различни от професионалните Ви такива? Какъв е опитът Ви в тези сфери?</th>
                        <th>Разкажете ни за трудна ситуация/проблем и как сте се справили?</th>
                        <th>Желая да променя/подобря...</th>
                        <th>Средно по колко часа седмично би отделял/а на проекта?</th>
                        <th>По какъв проект бихте работили със своя ученик?</th>
                        <th>Автобиография</th>
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
        function deleteMentor(formId) {
            if (confirm('Менторът ще бъде изтрит!')) {
                $('#' + formId).submit();
            }
        }
    </script>
@endpush
