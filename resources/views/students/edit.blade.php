@extends('layouts.app')

@section('title', 'Редакция на ' . $student->name . ' - Able Mentor')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ $student->name }}</h1>
    </div>
    <div class="card-body">
    	<form action="{{ route('students-update', ['student' => $student->id])}}" method="POST">
    		@csrf
            @method('PUT')

            <input type="hidden" name="gender_id" value="{{ $student->gender_id }}">

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                       <label>Име:</label>
                       <input class="form-control" type="text" name="name" value="{{ $student->name }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Години:</label>
                        <input class="form-control" type="number" name="age" value="{{ $student->age }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Email:</label>
                        <input class="form-control" type="text" name="email" value="{{ $student->email }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Телефон:</label>
                        <input class="form-control" type="text" name="phone" value="{{ $student->phone }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Град:</label>
                        <select name="city_id" class="form-control">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" @if($city->id == $student->city_id) selected="true" @endif>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Училище:</label>
                        <input class="form-control" type="text" name="school" value="{{ $student->school }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Клас:</label>
                        <select name="class_id" class="form-control">
                            @foreach ($schoolClasses as $schoolClass)
                                <option value="{{ $schoolClass->id }}" @if($schoolClass->id == $student->class_id) selected="true" @endif>
                                    {{ $schoolClass->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Ниво на английски:</label>
                        <select name="english_level_id" class="form-control">
                            @foreach ($englishLevels as $englishLevel)
                                <option value="{{ $englishLevel->id }}" @if($englishLevel->id == $student->english_level_id) selected="true" @endif>
                                    {{ $englishLevel->level }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Любими спортове:</label>
                        <div class="select2-info">
                            <select name="sport_ids[]" class="wpcf7-form-control wpcf7-select select2 wpcf7-validates-as-required"
                                    aria-required="true" style="width: 100%" aria-invalid="false" multiple="multiple" required>
                                @foreach($sports as $sport)
                                    <option value="{{ $sport->id }}"
                                        {{ in_array($sport->id, $student->sports->pluck('id')->toArray()) ? 'selected' : null }}>{{ $sport->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Любими предмети:</label>
                        <textarea class="form-control" rows="4" cols="50" name="favorite_subjects">{{ $student->favorite_subjects }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Хобита:</label>
                        <textarea class="form-control" rows="4" cols="50" name="hobbies">{{ $student->hobbies }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Планове след училище:</label>
                        <textarea class="form-control" rows="4" cols="50" name="after_school_plans">{{ $student->after_school_plans }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Сфери, които са ти интересни и искаш да се развиваш?</label>
                        <div class="select2-info">
                            <select name="spheres[]" class="wpcf7-form-control wpcf7-select select2 wpcf7-validates-as-required"
                                    aria-required="true" style="width: 100%" aria-invalid="false" multiple="multiple" required>
                                @foreach($spheres as $sphere)
                                    <option value="{{ $sphere->id }}"
                                        {{ in_array($sphere->id, $student->spheres->pluck('id')->toArray()) ? 'selected' : null }}>{{ $sphere->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Неща, които иска да промени:</label>
                        <textarea class="form-control" rows="4" cols="50" name="qualities_to_change">{{ $student->qualities_to_change }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Активности в свободното време:</label>
                        <textarea class="form-control" rows="4" cols="50" name="free_time_activities">{{ $student->free_time_activities }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Трудни ситуации:</label>
                        <textarea class="form-control" rows="4" cols="50" name="difficult_situations">{{ $student->difficult_situations }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Идея за осъществяване:</label>
                        <textarea class="form-control" rows="4" cols="50" name="program_achievments">{{ $student->program_achievments }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Желае да промени:</label>
                        <textarea class="form-control" rows="4" cols="50" name="want_to_change">{{ $student->want_to_change }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Източник на информация за Able Mentor:</label>
                        <textarea class="form-control" rows="4" cols="50" name="able_mentor_info_source">{{ $student->able_mentor_info_source }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <b>Тип проект:</b><br>
                        <div class="ml-5">
                            @foreach($projectTypes as $type)
                                <label>
                                    <input type="checkbox" name="project_type_ids[]" value="{{ $type->id }}"
                                        {{ $student->projectTypes && in_array($type->id, $student->projectTypes->pluck('id')->toArray()) ? 'checked' : null }}>
                                    {{ $type->type }}
                                </label>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="form-group">
                        <label>Часове седмично за проекта:</label>
                        <input class="form-control" type="text" name="hours" value="{{ $student->hours }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Бележки:</label>
                <textarea class="form-control" rows="4" cols="50" name="notes">{{ $student->notes }}</textarea>
            </div>

            <button class="btn btn-success" style="float: right"><i class="fas fa-edit"></i> Редактирай</button>
    	</form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
