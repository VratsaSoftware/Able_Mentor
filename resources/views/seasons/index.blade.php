@extends('layouts.app')

@section('title', 'Сезони - Able Mentor')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            <div class="row">
                <div class="col">
                    Сезони
                </div>
            </div>
        </h1>
    </div>
    <div class="panel-body mt-5">
        <div class="responsive-datatable">
            <table class="table datatable-season table-striped table-bordered nowrap" style="border:1px; width: 100%">
                <thead>
                    <tr>
                        <th>Име на сезон</th>
                        <th>Начало</th>
                        <th>Край</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seasons as $season)
                        <tr>
                            <td>
                                {{ $season->name }}
                                @if($season->isCurrent())
                                    <b style="color: green; float: right">Текущ</b>
                                @elseif($season->isNew())
                                    <b style="color: green; float: right">Нов</b>
                                @else
                                    <b style="color: red; float: right">Отминал</b>
                                @endif
                            </td>
                            <td>{{ $season->start }}</td>
                            <td>{{ $season->end }}</td>
                            <td>
                                <form style="display:inline-block; float: right" action="{{ route('seasons.destroy', $season->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Сезонът ще бъде изтрит!')" class="btn btn-danger" {{ $season->isNew() ?: 'disabled' }}>
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('includes.datatable-scripts')
@endpush
