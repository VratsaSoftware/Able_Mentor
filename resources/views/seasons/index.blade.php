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
                @if(Auth::user()->isAdmin())
                    <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#createSeason">
                        <i class="fas fa-calendar-plus mr-1"></i> Добави
                    </button>
                @endif
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
                                    <b class="badge badge-success float-right">Текущ</b>
                                @elseif($season->id == $newOpenSeasonId)
                                    <b class="badge badge-success float-right">Нов</b>
                                @elseif($season->isNew())
                                    <b class="badge badge-warning float-right">Бъдещ</b>
                                @else
                                    <b class="badge badge-danger float-right">Отминал</b>
                                @endif
                            </td>
                            <td>{{ $season->start }}</td>
                            <td>{{ $season->end }}</td>
                            <td>
                                <form style="display:inline-block; float: right" action="{{ route('seasons.destroy', $season->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Сезонът ще бъде изтрит!')" class="btn btn-danger" {{ $season->isNew() && $season->id !== $newOpenSeasonId ?: 'disabled' }}>
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

    @include('seasons.partials.create-modal')
@endsection

@push('scripts')
    @include('includes.datatable-scripts')
@endpush
