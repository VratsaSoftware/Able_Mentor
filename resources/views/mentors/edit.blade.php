@extends('layouts.app')

@section('title', __('Редакция на ' . $mentor->name . ' - Able Mentor'))

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ $mentor->name }}</h1>
    </div>
    <div class="card-body">
    	<form action="{{ route('mentors-update', ['mentor' => $mentor->id])}}" method="POST" id="mentorInfo" enctype="multipart/form-data">
    		@csrf
            @method('PUT')

            <input type="hidden" name="gender_id" value="{{ $mentor->gender_id }}">

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Име:</label>
                        <input class="form-control" type="text" name="name" value="{{ $mentor->name }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Възраст:</label>
                        <input class="form-control" type="number" name="age" value="{{ $mentor->age }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Имейл:</label>
                        <input class="form-control" type="text" name="email" value="{{ $mentor->email }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Телефон:</label>
                        <input class="form-control" type="text" name="phone" value="{{ $mentor->phone }}">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Сезон в който си бил ментор:</label>
                        <select name="previous_season_id" class="form-control">
                            @foreach( $seasons as $season )
                                <option value="{{ $season->id }}" @if( $season->id == $mentor->previous_season_id ) selected="true" @endif>
                                    {{ $season->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Град, в който ще участвате в ABLE Mentor:</label>
                        <select name="city_id" class="form-control">
                            @foreach( $cities as $city )
                                <option value="{{ $city->id }}" @if( $city->id == $mentor->city_id ) selected="true" @endif>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Месторабота:</label>
                        <input class="form-control" type="text" name="work" value="{{ $mentor->work }}">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Средно по колко часа седмично бихте отделяли на проекта:</label>
                        <input class="form-control" type="text" name="hours" value="{{ $mentor->hours }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Образование (специалност, степен и име на учебно заведение):</label>
                        <textarea class="form-control" rows="4" cols="50" name="education" form="mentorInfo">{{ $mentor->education }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Сфери, в които имате опит и интереси?</label>
                        <div class="select2-info">
                            <select name="spheres[]" class="wpcf7-form-control wpcf7-select select2 wpcf7-validates-as-required"
                                    aria-required="true" style="width: 100%;" aria-invalid="false" multiple="multiple" required>
                                @foreach($spheres as $sphere)
                                    <option value="{{ $sphere->id }}"
                                        {{ in_array($sphere->id, $mentor->spheres->pluck('id')->toArray()) ? 'selected' : null }}>{{ $sphere->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Интереси/хобита/компетенции, различни от професионалните:</label>
                        <textarea class="form-control" rows="4" cols="50" name="expertise" form="mentorInfo">{{ $mentor->expertise }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Трудна ситуация/проблем и как сте се справили:</label>
                        <textarea class="form-control" rows="4" cols="50" name="difficult_situations" form="mentorInfo">{{ $mentor->difficult_situations }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Желая да променя/подобря:</label>
                        <textarea class="form-control" rows="4" cols="50" name="want_to_change" form="mentorInfo">{{ $mentor->want_to_change }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Източник на информация за Able Mentor:</label>
                        <textarea class="form-control" rows="4" cols="50" name="able_mentor_info" form="mentorInfo">{{ $mentor->able_mentor_info }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <b>Тип проект:</b><br>
                        <div class="ml-5">
                            @foreach($projectTypes as $type)
                                <label>
                                    <input type="checkbox" name="project_type_ids[]" value="{{ $type->id }}"
                                        {{ $mentor->projectTypes && in_array($type->id, $mentor->projectTypes->pluck('id')->toArray()) ? 'checked' : null }}>
                                    {{ $type->type }}
                                </label>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Бележки:</label>
                        <textarea class="form-control" rows="4" cols="50" name="notes" form="mentorInfo">{{ $mentor->notes }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 text-lg-left text-center">
                    <div class="form-group">
                        <label>
                            Автобиография
                            <input type="file" name="cv" size="40" accept=".pdf,.txt,.jpg,.png,.jpeg">
                        </label>

                        @if($mentor->cv_path)
                            <a href="{{ asset('cv/' . $mentor->cv_path) }}" download="{{ $mentor->name }}">Свали</a>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-lg-right text-center">
                    <div class="form-group">
                        <button class="btn btn-success"><i class="fas fa-edit"></i> Редактирай</button>
                    </div>
                </div>
            </div>
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
