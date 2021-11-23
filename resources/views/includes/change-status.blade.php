<form action="{{ route($routeName) }}" method="get">
    <input name="status" type="hidden" value="{{ Request::get('status') == 'approved' || !Request::get('status') ? 'pending' : 'approved' }}">
    <button class="btn btn-warning mt-3">
        <i class="fas fa-users"></i> {{ Request::get('status') == 'approved' || !Request::get('status') ? 'Изчакващи' : 'Одобрени' }}
    </button>
</form>
