@if(Auth::user()->isAdmin() && Request::segment(2) !== config('consts.MENTOR_STATUS.new_season_approved'))
    <label for="file" style="float:right;">
        <span class="btn btn-success mt-3">
            <i class="fas fa-file-upload"></i> Импорт
        </span>
    </label>

    <form id="importData" action="{{ route($routeName) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input id="file" type="file" onchange="importData()" name="file" accept="text/csv" style="display:none">
        <input type="hidden" name="seasonStatus" value="{{ Request::segment(2) }}">
        @if(isset($pastSeasons))
            <input type="hidden" name="seasonId" value="{{ Request::get('seasonId') ?: $pastSeasons->first()->id }}">
        @endif
    </form>

    @push('scripts')
        <script>
            function importData() {
                if(confirm('Файлът ще бъде импортиран!')) {
                    $('#importData').submit();
                } else {
                    $('#file').val('');
                }
            }
        </script>
    @endpush
@endif
