@extends('layouts.admin')

@section('pageHeader')
	<h1>Uređivanje korisnika</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-6">
			{{ Form::model($user) }}

				<div class="form-group">
					{{ Form::label('first_name', 'Ime') }}
					{{ Form::text('first_name', null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
					{{ Form::label('email', 'Email') }}
					{{ Form::text('email', null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
					{{ Form::label('last_name', 'Prezime') }}
					{{ Form::text('last_name', null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
					{{ Form::label('gender', 'Spol') }}
					{{ Form::select('gender', ['m' => 'Muško', 'f' => 'Žensko'], null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
					{{ Form::label('city', 'Grad') }}
					{{ Form::text('city', null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
					{{ Form::label('postcode', 'Poštanski broj') }}
					{{ Form::text('postcode', null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
					{{ Form::label('address', 'Adresa') }}
					{{ Form::text('address', null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
					{{ Form::label('dob', 'Datum rođenja') }}
					{{ Form::text('dob', null, ['class' => 'form-control']) }}
				</div>

				<div class="form-group">
					{{ Form::label('telephone', 'Telefon') }}
					{{ Form::text('telephone', null, ['class' => 'form-control']) }}
				</div>

				<hr>

				<button type="submit" class="btn btn-success">Spremi promjene</button>
				<a class="btn btn-default" href="/admin/users">Odustani</a>

			{{ Form::close() }}
		</div>
	</div>
@stop