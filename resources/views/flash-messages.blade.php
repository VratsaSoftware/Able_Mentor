<link href="{{ asset('css/flash-messages.css') }}">

@if ($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif
<style>
    .alert-success {
        background-color: #d1e7dd;
    }

    .alert-danger {
        background-color: #ffebe9;
    }

    .alert-warning {
        background-color: #fff8c5;
    }

    .alert-info {
        background-color: #ddf4ff;
    }
</style>
@if ($success = Session::get('success'))
    <div class="alert alert-success">
        {{ $success }}
    </div>
@endif

@if ($error = Session::get('error'))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif

@if ($warning = Session::get('warning'))
    <div class="alert alert-warning">
        {{ $warning }}
    </div>
@endif

@if ($info = Session::get('info'))
    <div class="alert alert-info">
        {{ $info }}
    </div>
@endif

<script>
    $(document).ready(function () {
        // $('.alert').show().fadeOut(5000);
        //
        // $('.alert').click(function () {
        //     $(this).hide();
        // });
    });
</script>
