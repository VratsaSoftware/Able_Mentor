@extends('layouts.app')

@section('title')
{{ __('Редакция на ' . $mentor->name . ' ' . $mentor->name_second . ' - Able Mentor') }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Обнови информацията за ' . $mentor->name . ' ' . $mentor->name_second) }}</h1>
    </div>
    <div class="card-body">  
    	<form action="{{ route('mentors-update', ['mentor' => $mentor->id])}}" method="POST" id="mentorInfo" enctype="multipart/form-data">
    		{{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
				<label>Име:</label>
				<input class="form-control" type="text" name="name" value="{{ $mentor->name }}">
			</div>	
			<div class="form-group">
				<label>Фамилия:</label>
				<input class="form-control" type="text" name="name_second" value="{{ $mentor->name_second }}">
			</div>	
			<div class="form-group">
				<label>Възраст:</label>
				<input class="form-control" type="number" name="age" value="{{ $mentor->age }}">
			</div> 
			<div class="form-group">
				<label>Имейл:</label>
				<input class="form-control" type="text" name="email" value="{{ $mentor->email }}">
			</div>
			<div class="form-group">
				<label>Телефон:</label>
				<input class="form-control" type="text" name="phone" value="{{ $mentor->phone }}">
			</div> 
			<div class="form-group">
				<label>Ако сте били ментор в програмата досега, моля отбележете в кой сезон:</label>
				<input class="form-control" type="text" name="season" value="{{ $mentor->season }}">
			</div> 
			<div class="form-group">
				<label>Град, в който ще участвате в ABLE Mentor:</label>
				<select name="city" class="form-control">					
					@foreach( $cities as $city )						
						<option value="{{ $city->id }}" @if( $city->id == $mentor->city_id ) selected="true" @endif>
							{{ $city->name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Месторабота:</label>
				<input class="form-control" type="text" name="work" value="{{ $mentor->work }}">
			</div> 
			<div class="form-group">
				<label>Образование (специалност, степен и име на учебно заведение):</label>
				<textarea class="form-control" rows="4" cols="50" name="education" form="mentorInfo">{{ $mentor->education }}</textarea>	
			</div>
			<div class="form-group">
				<label>Професионален опит/интереси:</label>
				<textarea class="form-control" rows="4" cols="50" name="experience" form="mentorInfo">{{ $mentor->experience }}</textarea>	
			</div>
			<div class="form-group">
				<label>Интереси/хобита/компетенции, различни от професионалните:</label>
				<textarea class="form-control" rows="4" cols="50" name="expertise" form="mentorInfo">{{ $mentor->expertise }}</textarea>	
			</div>
			<div class="form-group">
				<label>Трудна ситуация/проблем и как сте се справили:</label>
				<textarea class="form-control" rows="4" cols="50" name="difficult_situations" form="mentorInfo">{{ $mentor->difficult_situations }}</textarea>	
			</div>
			<div class="form-group">
				<label>Желая да променя/подобря:</label>
				<textarea class="form-control" rows="4" cols="50" name="want_to_change" form="mentorInfo">{{ $mentor->want_to_change }}</textarea>	
			</div>
			<div class="form-group">
				<label>Средно по колко часа седмично бихте отделяли на проекта:</label>
				<input class="form-control" type="text" name="hours" value="{{ $mentor->hours }}">
			</div>
			<div class="form-group">
				<label>По какъв проект бихте работили със своя ученик:</label>
				<select name="project_type_id" class="form-control">					
					@foreach( $project_types as $type )						
						<option value="{{ $type->id }}" @if( $type->id == $mentor->project_type_id ) selected="true" @endif>
							{{ $type->type }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label>Източник на информация за Able Mentor:</label>
				<textarea class="form-control" rows="4" cols="50" name="able_mentor_info" form="mentorInfo">{{ $mentor->able_mentor_info }}</textarea>	
			</div>		
			<div class="form-group">
				<label>Бележки:</label>
				<textarea class="form-control" rows="4" cols="50" name="notes" form="mentorInfo">{{ $mentor->notes }}</textarea>	
			</div>			
            <input type="hidden" id="mentorId" name="mentorId" value="{{$mentor->id}}">
            <input type="submit" name="submit" value="Запази">			
    	</form>
    </div>
@endsection