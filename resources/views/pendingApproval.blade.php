@extends('layouts.app')

@section('title', 'Студенти - Able Mentor')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('content')
    <div class="container-fluid text-center">
        <h1 class="text-black-50">
            Изчаквате одобрение!
        </h1>
    </div>
@endsection
