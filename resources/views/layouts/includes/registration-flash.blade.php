@if ($success = Session::get('success'))
    <div class="alert alert-success" style="background-color: #d1e7dd">
        {{ $success }}
    </div>
@endif

@if ($error = Session::get('error'))
    <div class="alert alert-danger" style="background-color: #ecbfbb">
        {{ $error }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" style="background-color: #ecbfbb">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif
