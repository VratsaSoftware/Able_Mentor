@extends('layouts.app')

@section('title')
{{ __('Профил на ' . $student->name . ' ' . $student->name_second . ' - Able Mentor') }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Профил на ' . $student->name . ' ' . $student->name_second) }}</h1>
    </div>
    <div class="card-body">
    	<a href="{{ route('students-edit', $student['id']) }}" class="text-black-15" >Редактирай информацията</a>
    	<div class="form-group">
			<label>Име:</label>
			<div class="form-control">
				{{ $student->name . ' ' . $student->name_second }}
			</div>
		</div>	 
    	<div class="form-group">
			<label>Години:</label>
			<div class="form-control">
				{{ $student->age }}
			</div>
		</div>
		<div class="form-group">
			<label>Електронна поща:</label>
			<div class="form-control">
				{{ $student->email }}
			</div>
		</div>	 
    	<div class="form-group">
			<label>Телефон:</label>
			<div class="form-control">
				{{ $student->phone }}
			</div>
		</div>	 
    	<div class="form-group">
			<label>Пол:</label>
			<div class="form-control">
				{{ $gender->gender }}
			</div>
		</div>
		<div class="form-group">
			<label>Град:</label>
			<div class="form-control">
				{{ $city->name }}
			</div>
		</div>
		<div class="form-group">
			<label>Училище:</label>
			<div class="form-control">
				{{ $student->school }}
			</div>
		</div>
    	<div class="form-group">
			<label>Клас:</label>
			<div class="form-control">
				{{ $class->class_name }}
			</div>
		</div>
    	<div class="form-group">
			<label>Любими предмети:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->favorite_subjects }}</textarea>	
		</div>
		<div class="form-group">
			<label>Хобита:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->hobbies }}</textarea>	
		</div>
		<div class="form-group">
			<label>Ниво на английски:</label>
			<div class="form-control">
				{{ $english_level->level }}
			</div>
		</div>
	  	<div class="form-group">
			<label>Любим спорт:</label>
			<div class="form-control">
				 {{ $sport->name }}
			</div>
		</div>
	    <div class="form-group">
			<label>Планове след училище:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->after_school_plans }}</textarea>	
		</div>
	    <div class="form-group">
			<label>Силни/Слаби страни:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->strong_weak_sides }}</textarea>	
		</div>
	    <div class="form-group">
			<label>Неща, които иска да промени:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->qualities_to_change }}</textarea>	
		</div>
	    <div class="form-group">
			<label>Активности в свободното време:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->free_time_activities }}</textarea>	
		</div>
	    <div class="form-group">
			<label>Трудни ситуации:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->difficult_situations }}</textarea>	
		</div>
	    <div class="form-group">
			<label>Идея за осъществяване:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->program_achievments }}</textarea>	
		</div>
	   	<div class="form-group">
			<label>Желае да промени:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->want_to_change }}</textarea>	
		</div>
	    <div class="form-group">
			<label>Часове седмично за проекта:</label>
			<div class="form-control">
				{{ $student->hours }}
			</div>
		</div>
	    <div class="form-group">
			<label>Тип проект:</label>
			<div class="form-control">
				{{ $project_type->type }}
			</div>
		</div>
	    <div class="form-group">
			<label>Източник на информация за Able Mentor:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->able_mentor_info_source }}</textarea>	
		</div>   
		<div class="form-group">
			<label>Бележки:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $student->notes }}</textarea>	
		</div>    	 	
    </div>
@endsection