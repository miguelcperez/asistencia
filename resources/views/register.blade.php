@extends('layout')
@section('content')
<div class="container">
	<div class="row text-center">
		<h1>Registro de Personal</h1>
	</div>
	<hr>
	@if (session('message'))
	    <div class="alert alert-success">
	        {{ session('message') }}
	    </div>
	@endif
	<div class="row">
		<form action="/registro" method="post" class="form-horizontal" id = "Form-Register">
			<div class="col-sm-12">
				<div class="panel" id="DataPanel">
					<div class="panel-heading">
						<h3>Datos Personales</h3>
					</div>
					<div class="panel-body">
						@if (count($errors) > 0)
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						<div class="form-group">
							<label for="Code" class="col-sm-4 control-label">Codigo</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="Code" name="code" placeholder="Codigo de Personal"  autocomplete="off" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('code') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="Name" class="col-sm-4 control-label">Apellidos y Nombres</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="Name" name="name" placeholder="Apellidos y Nombres"  autocomplete="off" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('name') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="PayPerHour" class="col-sm-4 control-label">Pago por Hora</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="PayPerHour" name="payperhour" placeholder="Pago por Hora"  autocomplete="off" value="{{ old('payperhour') }}">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="panel" id="SchedulePanel">
					<div class="panel-heading">
						<h3>Horario de Trabajo</h3>
					</div>
					<div class="panel-body text-center">
						<div class="col-sm-2 col-sm-offset-1" data-toggle="button">
							<h4>Lunes</h4>
							<button type="button" class="btn btn-default btn-block btn-hour">7:30 - 8:25</button>
							<button type="button" class="btn btn-default btn-block btn-hour">8:25 - 9:10</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:10 - 9:55</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:55 - 10:40</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:00 - 11:50</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:50 - 12:35</button>
							<button type="button" class="btn btn-default btn-block btn-hour">12:35 - 13:20</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Martes</h4>
							<button type="button" class="btn btn-default btn-block btn-hour">7:30 - 8:25</button>
							<button type="button" class="btn btn-default btn-block btn-hour">8:25 - 9:10</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:10 - 9:55</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:55 - 10:40</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:00 - 11:50</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:50 - 12:35</button>
							<button type="button" class="btn btn-default btn-block btn-hour">12:35 - 13:20</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Miercoles</h4>
							<button type="button" class="btn btn-default btn-block btn-hour">7:30 - 8:25</button>
							<button type="button" class="btn btn-default btn-block btn-hour">8:25 - 9:10</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:10 - 9:55</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:55 - 10:40</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:00 - 11:50</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:50 - 12:35</button>
							<button type="button" class="btn btn-default btn-block btn-hour">12:35 - 13:20</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Jueves</h4>
							<button type="button" class="btn btn-default btn-block btn-hour">7:30 - 8:25</button>
							<button type="button" class="btn btn-default btn-block btn-hour">8:25 - 9:10</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:10 - 9:55</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:55 - 10:40</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:00 - 11:50</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:50 - 12:35</button>
							<button type="button" class="btn btn-default btn-block btn-hour">12:35 - 13:20</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Viernes</h4>
							<button type="button" class="btn btn-default btn-block btn-hour">7:30 - 8:25</button>
							<button type="button" class="btn btn-default btn-block btn-hour">8:25 - 9:10</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:10 - 9:55</button>
							<button type="button" class="btn btn-default btn-block btn-hour">9:55 - 10:40</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:00 - 11:50</button>
							<button type="button" class="btn btn-default btn-block btn-hour">11:50 - 12:35</button>
							<button type="button" class="btn btn-default btn-block btn-hour">12:35 - 13:20</button>
						</div>
						<div class="col-sm-6 col-md-offset-3">
							<button type="submit" id="BtnSave" class="btn btn-primary btn-block">
								GUARDAR
							</button>
						</div>
					</div>
				</div>
			</div>
			
			<input type="hidden" name="hours_array" id="HoursArray">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>
@stop
@section('styles')
@stop
@section('scripts')
<script>
$(document).ready(function() {
	var array;
	$('.btn-hour').each(function(i) {
		$(this).attr('id', i + 1);
		console.log($(this).attr('id'));
	});
		console.log($('#HoursArray').val());

	$('#Form-Register').submit(function(e) {
			var form = $('#Form-Register')
			var data;
			array = [];
			$('.btn-hour').each(function() {
				if($(this).hasClass('active')) {
					array.push($(this).attr('id'));
				}
			});
			$('#HoursArray').val(array);
			data = form.serializeArray();
	});
});
</script>
@stop