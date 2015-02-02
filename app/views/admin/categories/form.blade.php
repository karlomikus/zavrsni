@extends('layouts.admin')

@section('pageHeader')
    <h1>Uređivanje kategorije</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            {{ Form::model($category) }}

                <div class="form-group">
                    {{ Form::label('name', 'Ime kategorije') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('description', 'Opis kategorije') }}
                    {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                </div>

                <hr>

                <button type="submit" class="btn btn-success">Spremi promjene</button>
                <a class="btn btn-default" href="/admin/categories">Odustani</a>

            {{ Form::close() }}
        </div>
    </div>
@stop