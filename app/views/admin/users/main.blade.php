@extends('layouts.admin')

@section('pageHeader')
    <h1>Korisnici</h1>
@stop

@section('content')

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <a href="/admin/users/create" class="btn btn-primary">Dodaj novog korisnika</a>
    <hr>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Email</th>
                <th>Ime i prezime</th>
                <th>Grad</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="/admin/users/edit/{{ $user->id }}">{{{ $user->email }}}</a></td>
                    <td>{{{ $user->fullName }}}</td>
                    <td>{{{ $user->city }}}</td>
                    <td>
                        @if($user->isBanned)
                            <a href="/admin/users/changeban/{{ $user->id }}" class="btn btn-success btn-xs">Unban</a>
                        @else
                            <a href="/admin/users/changeban/{{ $user->id }}" class="btn btn-warning btn-xs">Ban</a>
                        @endif
                        <a href="/admin/users/delete/{{ $user->id }}" class="btn btn-danger btn-xs">Obriši</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@stop