@extends('layouts.app')

@section('title', 'Сезони - Able Mentor')

@push('head')
    @include('includes.datatable-head')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    @include('seasons.partials.create-modal')

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
                        <th>Начало на сезона</th>
                        <th>Край на сезона</th>
                        <th>Градове</th>
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
                                @foreach($season->cities as $city)
                                    {{ $city->name }}
                                @endforeach
                            </td>
                            <td>
                                <form style="display:inline-block; float: right" action="{{ route('seasons.destroy', $season->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Сезонът ще бъде изтрит!')" class="btn btn-danger float-right m-1" {{ $season->isNew() && $season->id !== $newOpenSeasonId ?: 'disabled' }}>
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                                <button class="btn btn-success float-right m-1" data-toggle="modal" data-target="#editSeason-{{ $loop->iteration }}" {{ $season->isNew() ?: 'disabled' }}>
                                    <i class="fa fa-pen"></i>
                                </button>
                            </td>
                        </tr>

                        @include('seasons.partials.edit-modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('includes.datatable-scripts')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
