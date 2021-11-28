@if (Request::get('success'))
    <div class="alert alert-success" style="background-color: #d1e7dd">
        {{ Request::get('success') }}
    </div>
@endif

@if (Request::get('name'))
    <div class="alert alert-danger" style="background-color: #ecbfbb">
        Грешка! Моля проверете формата за грешки!
    </div>
@endif
