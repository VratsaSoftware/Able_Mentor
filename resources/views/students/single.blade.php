@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('Профил на ' . $student->name . ' ' . $student->name_second) }}</h1>
    </div>
    <div class="panel-body">
    	<a href="{{ route('students-update', $student['id']) }}" class="text-black-15" >Обнови информацията</a>

    </div>
@endsection