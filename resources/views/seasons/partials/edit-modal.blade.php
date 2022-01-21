@if($season->isNew())
    <div class="modal fade" id="editSeason-{{ $loop->iteration }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирай на сезон</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editSeasonForm-{{ $loop->iteration }}" method="post" action="{{ route('seasons.update', $season->id) }}">
                        @method('PUT')
                        @csrf

                        @include('seasons.partials.form')
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отказ</button>
                    <button type="submit" class="btn btn-success" form="editSeasonForm-{{ $loop->iteration }}">Редактирай</button>
                </div>
            </div>
        </div>
    </div>
@endif
