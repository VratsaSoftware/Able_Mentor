@extends('layouts.app')

@section('title', 'Ученици - Able Mentor')

@push('head')
    @include('includes.datatable-head')
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">
            Потребители
        </h1>
    </div>
    <div class="panel-body mt-5">
        <div class="responsive-datatable">
            <table class="table datatable table-striped table-bordered nowrap" style="border:1px; width: 100%">
                <thead>
                <tr>
                    <th>Име</th>
                    <th>Email</th>
                    <th>Регистриран</th>
                    <th>Роля</th>
                </tr>
                </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <form action="{{ route('users.update', $user->id) }}" style="float: left" method="post">
                                        @csrf
                                        @method('put')
                                        <select name="role" onchange="this.form.submit()" {{ $loop->first ? 'disabled' : null }}>
                                            <option selected disabled>Роля</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : null }}>Администратор</option>
                                            <option value="operator" {{ $user->role == 'operator' ? 'selected' : null }}>Оператор</option>
                                        </select>
                                    </form>
                                    <form style="display:inline-block; float: right" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Потребителят ще бъде изтрит!')" class="btn btn-danger" {{ $loop->first ? 'disabled' : null }}>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                <tfoot>
                    <tr>
                        <th>Име</th>
                        <th>Email</th>
                        <th>Регистриран</th>
                        <th>Роля</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('includes.datatable-scripts')
@endpush
