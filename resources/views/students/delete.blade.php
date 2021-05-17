@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Изтриване на ' . $student->name . ' ' . $student->name_second) }}</h1>
    </div>
    <div class="panel-body">    	
    	Ако сте сигурни, че искате да изтриете профила на студента {{ $student->name . ' ' . $student->name_second }}, то натиснете бутона "Изтрий"!
    	<p>
    	<form action="{{ route('students-destroy', $student->id) }}" method="POST">
            @csrf
    		@method('delete')

             <input class="btn btn-danger" type="submit" value="Изтрий" />
        </form>
    </div>
@endsection