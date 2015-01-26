@extends('layouts.admin')

@section('pageHeader')
    <h1>Projekti</h1>
@stop

@section('content')
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Ime projekta</th>
                <th>Autor</th>
                <th>Datum kreiranja</th>
                <th>Kategorija</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td><a href="/project/{{ $project->id }}" target="_blank">{{{ $project->title }}}</a></td>
                    <td>{{{ $project->user->fullName }}}</td>
                    <td>{{{ $project->created_at }}}</td>
                    <td><a href="/admin/categories/edit/{{ $project->category->id }}">{{ $project->category->name }}</a></td>
                    <td>
                        <a href="/admin/projects/delete/{{ $project->id }}" class="btn btn-xs btn-danger">Obriši</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $projects->links() }}
@stop