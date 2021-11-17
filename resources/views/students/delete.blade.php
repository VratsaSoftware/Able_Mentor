@extends('layouts.app')

@section('title')
{{ __('Изтриване на ' . $student->name . ' ' . $student->name_second . ' - Able Mentor') }}
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Изтриване на ' . $student->name . ' ' . $student->name_second) }}</h1>
    </div>
    <div class="panel-body">    	
    	Ако сте сигурни, че искате да изтриете профила на студента {{ $student->name . ' ' . $student->name_second }}, то натиснете бутона "Изтрий"!        
        <div style="margin-top: 20px;">
        	<a style="display:inline-block;" href="{{ url()->previous() }}" class="btn btn-success">Назад</a>
        	<form style="display:inline-block; margin-left: 10px" action="{{ route('students-destroy', $student->id) }}" method="POST">
                @csrf
        		@method('delete')
                <input class="btn btn-danger" type="submit" value="Изтрий" />
            </form>
        </div>
    </div>
@endsection