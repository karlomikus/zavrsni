@extends('layouts.admin')

@section('pageHeader')
    <h1>Korisnici</h1>
@stop

@section('content')
    <a href="/admin/users/create" class="btn btn-primary">Dodaj novog korisnika</a>
    <hr>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Ime i prezime</th>
                <th>Email</th>
                <th>Grad</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="/admin/users/edit/{{ $user->id }}">{{{ $user->fullName }}}</a></td>
                    <td>{{{ $user->email }}}</td>
                    <td>{{{ $user->city }}}</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-warning">Deactivate</a>
                        <a href="#" class="btn btn-xs btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop