@extends('layouts.app')

@section('title')
{{ __('Профил на ' . $mentor->name . ' ' . $mentor->name_second . ' - Able Mentor') }}
@endsection

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
                                        <a href="{{ route('mentors-edit', $mentor->id) }}" class="btn btn-success mt-3 float-right">
                                            <i class="fa fa-user-edit"></i>
                                        </a>
                                    @endif
                                <h3 class="profile-username text-center">{{ $mentor->name }}</h3>

                                <p class="text-muted text-center">{{ $mentor->currentSeason ? $mentor->currentSeason->name : '?' }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Възраст</b> <a class="float-right">{{ $mentor->age }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a href="mailto:{{ $mentor->email }}" class="float-right">{{ $mentor->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Телефон</b> <a href="tel:{{ $mentor->phone }}" class="float-right">{{ $mentor->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Предишен сезон</b> <a class="float-right">{{ $mentor->previousSeason ? $mentor->previousSeason->name : '?' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Автобиография</b>
                                        <div class="float-right">
                                            @if($mentor->cv_path)
                                                <a href="{{ asset('cv/' . $mentor->cv_path) }}" download="{{ $mentor->name }}">Свали <i class="fas fa-download"></i></a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ученици</h3>
                                <a href="{{ route('mentors.connect', $mentor->id) }}" class="btn btn-success float-right">
                                    <img src="{{ asset('img/user-connection-317.svg') }}" width="24px">
                                </a>
                            </div>
                            <div class="card-body">
                                @foreach($mentor->students as $student)
                                    <strong><i class="fas fa-book mr-1"></i> {{ $student->name }}</strong>
                                    <div class="text-muted">
                                        Проекти:
                                        <ul>
                                            @foreach($student->projectTypes as $projectType)
                                                <li>
                                                    <span style="color: {{ in_array($projectType->id, $mentor->projectTypes->pluck('id')->toArray()) ? 'green' : 'red' }}">{{ $projectType->type }}</span>
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
                                            {{ $mentor->hours }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Образование (специалност, степен и име на учебно заведение):</b>
                                            {{ $mentor->education }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Професионален опит/интереси:</b>
                                            {{ $mentor->experience }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Интереси/хобита/компетенции, различни от професионалните:</b>
                                            {{ $mentor->expertise }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Трудна ситуация/проблем и как сте се справили:</b>
                                            {{ $mentor->difficult_situations }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Желая да променя/подобря:</b>
                                            {{ $mentor->want_to_change }}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Източник на информация за Able Mentor:</b>
                                            {{ $mentor->able_mentor_info }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <b>Тип проект:</b>
                                            <ul>
                                                @foreach($mentor->projectTypes as $type)
                                                    <li>{{ $type->type }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <b><i class="fas fa-sticky-note"></i> Бележки:</b>
                                            {{ $mentor->notes }}
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
