<link href="{{ asset('css/flash-messages.css') }}">

@if ($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" style="background-color: #d1e7dd">
            {{ $error }}
        </div>
    @endforeach
@endif

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

@if ($warning = Session::get('warning'))
    <div class="alert alert-warning" style="background-color: #e6d978">
        {{ $warning }}
    </div>
@endif

@if ($info = Session::get('info'))
    <div class="alert alert-info" style="background-color: #c0e3f4">
        {{ $info }}
    </div>
@endif

<script>
    $(document).ready(function () {
        $('.alert').show().fadeOut(5000);

        $('.alert').click(function () {
            $(this).hide();
        });
    });
</script>
