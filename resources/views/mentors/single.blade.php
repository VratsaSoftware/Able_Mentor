@extends('layouts.app')

@section('title')
{{ __('Профил на ' . $mentor->name . ' ' . $mentor->name_second . ' - Able Mentor') }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Профил на ' . $mentor->name . ' ' . $mentor->name_second) }}</h1>
    </div>
    <div class="card-body">
    	<a href="{{ route('mentors-edit', $mentor['id']) }}" class="text-black-15" >Редактирай информацията</a>
    	<div class="form-group">
			<label>Име и фамилия:</label>
			<div class="form-control">
				{{ $mentor->name . ' ' . $mentor->name_second }}
			</div>
		</div> 
		<div class="form-group">
			<label>Възраст:</label>
			<div class="form-control">
				{{ $mentor->age }}
			</div>
		</div>  
		<div class="form-group">
			<label>Имейл:</label>
			<div class="form-control">
				{{ $mentor->email }}
			</div>
		</div>  
		<div class="form-group">
			<label>Телефон:</label>
			<div class="form-control">
				{{ $mentor->phone }}
			</div>
		</div>     
		<div class="form-group">
			<label>Пол:</label>
			<div class="form-control">
				{{ $gender->gender }}
			</div>
		</div>	
		<div class="form-group">
			<label>Ако сте били ментор в програмата досега, моля отбележете в кой сезон:</label>
			<div class="form-control">
				{{ $mentor->season }}
			</div>
		</div>  
		<div class="form-group">
			<label>Град, в който ще участвате в ABLE Mentor:</label>
			<div class="form-control">
				{{ $city->name }}
			</div>
		</div>
		<div class="form-group">
			<label>Месторабота:</label>
			<div class="form-control">
				{{ $mentor->work }}
			</div>
		</div>
		<div class="form-group">
			<label>Образование (специалност, степен и име на учебно заведение):</label>
			<textarea class="form-control" rows="4" cols="50">{{ $mentor->education }}</textarea>	
		</div> 
		<div class="form-group">
			<label>Професионален опит/интереси:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $mentor->experience }}</textarea>	
		</div> 
		<div class="form-group">
			<label>Интереси/хобита/компетенции, различни от професионалните:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $mentor->expertise }}</textarea>	
		</div> 
		<div class="form-group">
			<label>Трудна ситуация/проблем и как сте се справили:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $mentor->difficult_situations }}</textarea>	
		</div> 
		<div class="form-group">
			<label>Желая да променя/подобря:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $mentor->want_to_change }}</textarea>	
		</div> 
		<div class="form-group">
			<label>Средно по колко часа седмично бихте отделяли на проекта:</label>
			<div class="form-control">
				{{ $mentor->hours }}
			</div>
		</div>
		<div class="form-group">
			<label>По какъв проект бихте работили със своя ученик:</label>
			<div class="form-control">
				{{ $project_type->type }}
			</div>
		</div>
		 <div class="form-group">
			<label>Източник на информация за Able Mentor:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $mentor->able_mentor_info }}</textarea>	
		</div> 
		<div class="form-group">
			<label>Бележки:</label>
			<textarea class="form-control" rows="4" cols="50">{{ $mentor->notes }}</textarea>	
		</div> 
    </div>
@endsection