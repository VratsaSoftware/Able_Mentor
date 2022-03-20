@extends('layouts.app')

@section('title', 'Ученици - Able Mentor')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('content')
    <div class="container-fluid text-center">
        <h1 class="text-black-50">
            <i class="fas fa-child mt-5 fa-3x"></i>
            <br>
            Изчаквате одобрение!
        </h1>
    </div>
@endsection
