@extends('layouts.admin')

@section('pageHeader')
    <h1>Kategorije</h1>
@stop

@section('content')
    <a href="/admin/categories/create" class="btn btn-primary">Kreiraj novu kategoriju</a>
    <hr>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Ime kategorije</th>
                <th>Opis</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td><a href="/admin/categories/edit/{{ $category->id }}">{{{ $category->name }}}</a></td>
                    <td>{{{ $category->description }}}</td>
                    <td>
                        <a href="/admin/categories/delete/{{ $category->id }}" class="btn btn-xs btn-danger">Obriši</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
@stop