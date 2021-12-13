@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

<div class="modal fade" id="createSeason">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавяне на сезон</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createSeasonForm" method="post" action="{{ route('seasons.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Име</label>
                        <input type="text" class="form-control" name="name" placeholder="Име" value="{{ 'Сезон ' . $seasons->last()->count() }}" required>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Начало</label>
                                <input type="date" class="form-control" name="start" placeholder="Начало дата" value="{{ \Carbon\Carbon::parse($seasons->last()->end)->addDay()->format('Y-m-d') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Край</label>
                                <input type="date" class="form-control" name="end" placeholder="Край дата" value="{{ \Carbon\Carbon::parse($seasons->last()->end)->addMonths(6)->format('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="select2-info">
                                    <select class="select2" name="cities[]" multiple="multiple" data-placeholder="Градове за провеждане" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отказ</button>
                <button type="submit" class="btn btn-success" form="createSeasonForm">Добави</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
