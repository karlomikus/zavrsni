@extends('layouts.admin')

@section('pageHeader')
	<h1>Kontrolni panel <small>Dobrodošli natrag!</small></h1>
@stop

@section('content')
    <div class="row">
    	<div class="col-md-5">
    		<div class="row">
    			<div class="col-md-3"><a href="/admin/projects" class="btn btn-primary btn-block"><i class="fa fa-archive fa-3x"></i><br>Pregled projekata</a></div>
    			<div class="col-md-3"><a href="/admin/users/create" class="btn btn-primary btn-block"><i class="fa fa-plus fa-3x"></i><br>Dodavanje korisnika</a></div>
    			<div class="col-md-3"><a href="/profile" class="btn btn-primary btn-block"><i class="fa fa-user fa-3x"></i><br>Moj profil</a></div>
    			<div class="col-md-3"><a href="/admin/settings" class="btn btn-primary btn-block"><i class="fa fa-cog fa-3x"></i><br>Postavke sustava</a></div>
    		</div>
    	</div>
    	<div class="col-md-7">
    		<canvas id="projects-chart" style="width: 100%; height: 400px;"></canvas>
    	</div>
    </div>
    <div class="row">
    	<div class="col-md-7">
    		Novi projekti:
    	</div>
    </div>
@stop