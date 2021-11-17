@extends('layouts.app')

@section('title')
{{ __('Свързване на ' . $mentor->name . ' ' . $mentor->name_second . ' - Able Mentor') }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Свързване на ментора ' . $mentor->name . ' ' . $mentor->name_second . ' със студента ' . $student->name . ' ' . $student->name_second ) }}</h1>
    </div>
    <div class="panel-body">    	
    	Ако сте сигурни, че искате да направите свързването, то натиснете бутона "Запази"!        
        <div style="margin-top: 20px;">
        	<a style="display:inline-block;" href="{{ url()->previous() }}" class="btn btn-success">Назад</a>
        	<form style="display:inline-block; margin-left: 10px" action="{{ route('mentors-confirm-connect', ['mentor' => $mentor['id'], 'student' => $student['id']]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
                <input class="btn btn-danger" type="submit" value="Запази" />
            </form>
        </div>
    </div>
@endsection