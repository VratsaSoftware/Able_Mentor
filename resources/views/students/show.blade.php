@extends('layouts.app')

@section('title', $student->name . ' - Able Mentor')

@section('content')
    <div class="card-body">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center"></div>
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('students-edit', $student->id) }}" class="btn btn-success mt-3 float-right">
                                        <i class="fa fa-user-edit"></i>
                                    </a>
                                @endif
                                <h3 class="profile-username text-center">{{ $student->name }}</h3>

                                <p class="text-muted text-center">Ученик {{ $student->season ? $student->season->name : '?' }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Възраст</b> <a class="float-right">{{ $student->age }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a href="mailto:{{ $student->email }}" class="float-right">{{ $student->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Телефон</b> <a href="tel:{{ $student->phone }}" class="float-right">{{ $student->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Град за участие</b> <a class="float-right">{{ $student->city ? $student->city->name : null }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ментори</h3>
                                <a href="{{ route('students.connect', $student->id) }}" class="btn btn-success float-right">
                                    <img src="{{ asset('img/user-connection-317.svg') }}" width="24px">
                                </a>
                            </div>
                            <div class="card-body">
                                @foreach($student->mentors as $mentor)
                                    <strong>
                                        <a href="{{ route('mentor.show', $mentor->id) }}"><i class="fas fa-chalkboard-teacher"></i> {{ $mentor->name }}</a>
                                    </strong>
                                    <div class="text-muted">
                                        Проекти:
                                        <ul>
                                            @foreach($mentor->projectTypes as $projectType)
                                                <li>
                                                    <span style="color: {{ in_array($projectType->id, $student->projectTypes->pluck('id')->toArray()) ? 'green' : 'red' }}">{{ $projectType->type }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if(!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Средно по колко часа седмично бихте отделяли на проекта:</b>
                                            {{ $student->hours }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Училище:</b>
                                            {{ $student->school }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Клас:</b>
                                            {{ $student->schoolClass ? $student->schoolClass->class_name : null }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Ниво на английски:</b>
                                            {{ $student->englishLevel ? $student->englishLevel->level : null }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Любим спорт:</b>
                                            {{ $student->sport ? $student->sport->name : null }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Любими предмети:</b>
                                            {{ $student->favorite_subjects }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Хобита:</b>
                                            {{ $student->hobbies }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Планове след училище:</b>
                                            {{ $student->after_school_plans }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Силни/Слаби страни:</b>
                                            {{ $student->strong_weak_sides }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Неща, които иска да промени:</b>
                                            {{ $student->qualities_to_change }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Активности в свободното време:</b>
                                            {{ $student->free_time_activities }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Трудни ситуации:</b>
                                            {{ $student->difficult_situations }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Идея за осъществяване:</b>
                                            {{ $student->program_achievments }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Желае да промени:</b>
                                            {{ $student->want_to_change }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Източник на информация за Able Mentor:</b>
                                            {{ $student->able_mentor_info_source }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Тип проект:</b>
                                            <div class="col-12 col-lg-6">
                                                <div class="form-group">
                                                    <b>Тип проект:</b>
                                                    <ul>
                                                        @foreach($student->projectTypes as $type)
                                                            <li>{{ $type->type }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <b><i class="fas fa-sticky-note"></i> Бележки:</b>
                                            {{ $student->notes }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
