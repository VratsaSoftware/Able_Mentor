@extends('layouts.app')

@section('title')
{{ __('Редакция на ' . $student->name . ' ' . $student->name_second . ' - Able Mentor') }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Обнови информацията за ' . $student->name . ' ' . $student->name_second) }}</h1>
    </div>
    <div class="card-body">  
    	<form action="{{ route('students-update', ['student' => $student->id])}}" method="POST" id="studentInfo" enctype="multipart/form-data">
    		{{ csrf_field() }}
            {{ method_field('PUT') }}
             <div class="form-group">
				<label>Име:</label>
				<input class="form-control" type="text" name="name" value="{{ $student->name }}">
			</div>	           
            <div class="form-group">
				<label>Фамилия:</label>
				<input class="form-control" type="text" name="name_second" value="{{ $student->name_second }}">
			</div>
           <div class="form-group">
				<label>Години:</label>
				<input class="form-control" type="number" name="age" value="{{ $student->age }}">
			</div>
            <div class="form-group">
				<label>Електронна поща:</label>
				<input class="form-control" type="text" name="email" value="{{ $student->email }}">
			</div>
            <div class="form-group">
				<label>Телефон:</label>
				<input class="form-control" type="text" name="phone" value="{{ $student->phone }}">
			</div>
            <div class="form-group">
				<label>Град:</label>
				<select name="city" class="form-control">					
					@foreach( $cities as $city )						
						<option value="{{ $city->id }}" @if( $city->id == $student->city_id ) selected="true" @endif>
							{{ $city->name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Училище:</label>
				<input class="form-control" type="text" name="school" value="{{ $student->school }}">
			</div>	
			<div class="form-group">
				<label>Клас:</label>
				<select name="schoolClass" class="form-control">					
					@foreach( $schoolClasses as $schoolClass )						
						<option value="{{ $schoolClass->id }}" @if( $schoolClass->id == $student->class_id ) selected="true" @endif>
							{{ $schoolClass->class_name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Любими предмети:</label>
				<textarea class="form-control" rows="4" cols="50" name="favorite_subjects" form="studentInfo">{{ $student->favorite_subjects }}</textarea>	
			</div>
			<div class="form-group">
				<label>Хобита:</label>
				<textarea class="form-control" rows="4" cols="50" name="hobbies" form="studentInfo">{{ $student->hobbies }}</textarea>	
			</div>
			<div class="form-group">
				<label>Ниво на английски:</label>
				<select name="englishLevel" class="form-control">					
					@foreach( $englishLevels as $englishLevel )						
						<option value="{{ $englishLevel->id }}" @if( $englishLevel->id == $student->english_level_id ) selected="true" @endif>
							{{ $englishLevel->level }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Любим спорт:</label>
				<select name="sport" class="form-control">					
					@foreach( $sports as $sport )						
						<option value="{{ $sport->id }}" @if( $sport->id == $student->sport_id ) selected="true" @endif>
							{{ $sport->name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Планове след училище:</label>
				<textarea class="form-control" rows="4" cols="50" name="after_school_plans" form="studentInfo">{{ $student->after_school_plans }}</textarea>	
			</div>
			<div class="form-group">
				<label>Силни/Слаби страни:</label>
				<textarea class="form-control" rows="4" cols="50" name="strong_weak_sides" form="studentInfo">{{ $student->strong_weak_sides }}</textarea>	
			</div>
			<div class="form-group">
				<label>Неща, които иска да промени:</label>
				<textarea class="form-control" rows="4" cols="50" name="qualities_to_change" form="studentInfo">{{ $student->qualities_to_change }}</textarea>	
			</div>
			<div class="form-group">
				<label>Активности в свободното време:</label>
				<textarea class="form-control" rows="4" cols="50" name="free_time_activities" form="studentInfo">{{ $student->free_time_activities }}</textarea>	
			</div>
			<div class="form-group">
				<label>Трудни ситуации:</label>
				<textarea class="form-control" rows="4" cols="50" name="difficult_situations" form="studentInfo">{{ $student->difficult_situations }}</textarea>	
			</div>
			<div class="form-group">
				<label>Идея за осъществяване:</label>
				<textarea class="form-control" rows="4" cols="50" name="program_achievments" form="studentInfo">{{ $student->program_achievments }}</textarea>	
			</div>
			<div class="form-group">
				<label>Желае да промени:</label>
				<textarea class="form-control" rows="4" cols="50" name="want_to_change" form="studentInfo">{{ $student->want_to_change }}</textarea>	
			</div>
			 <div class="form-group">
				<label>Часове седмично за проекта:</label>
				<input class="form-control" type="text" name="hours" value="{{ $student->hours }}">
			</div>
			<div class="form-group">
				<label>Тип проект:</label>
				<select name="project_types" class="form-control">					
					@foreach( $project_types as $type )						
						<option value="{{ $type->id }}" @if( $type->id == $student->project_type_id ) selected="true" @endif>
							{{ $type->type }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Източник на информация за Able Mentor:</label>
				<textarea class="form-control" rows="4" cols="50" name="able_mentor_info_source" form="studentInfo">{{ $student->able_mentor_info_source }}</textarea>	
			</div>
			<div class="form-group">
				<label>Бележки:</label>
				<textarea class="form-control" rows="4" cols="50" name="notes" form="studentInfo">{{ $student->notes }}</textarea>	
			</div>
            <input type="hidden" id="studentId" name="studentId" value="{{$student->id}}">
            <input type="submit" name="submit" value="Запази">			
    	</form>
    </div>
@endsection