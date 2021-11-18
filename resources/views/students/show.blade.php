@extends('layouts.app')

@section('title', 'Профил - ' . $student->name . ' ' . $student->name_second . ' - Able Mentor')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ $student->name }}</h1>
    </div>
    <div class="card-body">
    	<a href="{{ route('students-edit', $student->id) }}" class="text-black-15" >Редактирай информацията</a>
    	<div class="form-group">
			<label>Възраст:</label>
			<div class="box-info">
				{{ $student->age }}
			</div>
		</div>
		<div class="form-group">
			<label>Електронна поща:</label>
			<div class="box-info">
				{{ $student->email }}
			</div>
		</div>
    	<div class="form-group">
			<label>Телефон:</label>
			<div class="box-info">
				{{ $student->phone }}
			</div>
		</div>
    	<div class="form-group">
			<label>Пол:</label>
			<div class="box-info">
				{{ $student->gender_id }} //add relations
			</div>
		</div>
		<div class="form-group">
			<label>Град:</label>
			<div class="box-info">
				{{ $student->city_id }} //add relations
			</div>
		</div>
		<div class="form-group">
			<label>Училище:</label>
			<div class="box-info">
				{{ $student->school }}
			</div>
		</div>
    	<div class="form-group">
			<label>Клас:</label>
			<div class="box-info">
				{{ $student->class_id }} //add relations
			</div>
		</div>
    	<div class="form-group">
			<label>Любими предмети:</label>
			<div class="box-info">{{ $student->favorite_subjects }}</div>
		</div>
		<div class="form-group">
			<label>Хобита:</label>
			<div class="box-info">{{ $student->hobbies }}</div>
		</div>
		<div class="form-group">
			<label>Ниво на английски:</label>
			<div class="box-info">
				{{ $student->english_level_id }} //add relations
			</div>
		</div>
	  	<div class="form-group">
			<label>Любим спорт:</label>
			<div class="box-info">
				 {{ $student->sport_id }} //add relations
			</div>
		</div>
	    <div class="form-group">
			<label>Планове след училище:</label>
			<div class="box-info">{{ $student->after_school_plans }}</div>
		</div>
	    <div class="form-group">
			<label>Силни/Слаби страни:</label>
			<div class="box-info">{{ $student->strong_weak_sides }}</div>
		</div>
	    <div class="form-group">
			<label>Неща, които иска да промени:</label>
			<div class="box-info">{{ $student->qualities_to_change }}</div>
		</div>
	    <div class="form-group">
			<label>Активности в свободното време:</label>
			<div class="box-info">{{ $student->free_time_activities }}</div>
		</div>
	    <div class="form-group">
			<label>Трудни ситуации:</label>
			<div class="box-info">{{ $student->difficult_situations }}</div>
		</div>
	    <div class="form-group">
			<label>Идея за осъществяване:</label>
			<div class="box-info">{{ $student->program_achievments }}</div>
		</div>
	   	<div class="form-group">
			<label>Желае да промени:</label>
            <div class="box-info">
                {{ $student->want_to_change }}
            </div>
		</div>
	    <div class="form-group">
			<label>Часове седмично за проекта:</label>
            <div class="box-info">
				{{ $student->hours ?: 'Повече' }}
			</div>
		</div>
	    <div class="form-group">
			<label>Тип проект:</label>
            <div class="box-info">
				{{ $student->projectTypes }} //add foreach
			</div>
		</div>
	    <div class="form-group">
			<label>Източник на информация за Able Mentor:</label>
            <div class="box-info">
			    {{ $student->able_mentor_info_source }}
            </div>
		</div>
		<div class="form-group">
			<label>Бележки:</label>
            <div class="box-info">
                {{ $student->notes }}
            </div>
		</div>
    </div>
@endsection
