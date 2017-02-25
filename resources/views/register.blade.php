@extends('layout')
@section('content')
<div class="container">
	<div class="row">
		<h1>Registro de Personal</h1>
	</div>
	<hr>
	@if (session()->has('message'))
	    <div class="alert alert-success">
	        {!! session('message') !!}
	    </div>
	@endif
	<div class="row">
		<form action="/registro" method="post" class="form-horizontal">
			<div class="col-sm-12">
				<div class="panel" id="DataPanel">
					<div class="panel-heading">
						<h3>Datos Personales</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="code" class="col-sm-4 control-label">Codigo</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="code" name="code" placeholder="Codigo de Personal">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-4 control-label">Apellidos y Nombres</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="name" name="name" placeholder="Apellidos y Nombres">
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
						<div class="col-sm-2" data-toggle="button">
							<h4>Lunes</h4>
							<button type="button" class="btn btn-default btn-block"  onclick = "selectHour()">7:00 - 8:00</button>
							<button type="button" class="btn btn-default btn-block" onclick = "selectHour()">8:00 - 9:00</button>
							<button type="button" class="btn btn-default btn-block" onclick = "selectHour()">9:00 - 10:00</button>
							<button type="button" class="btn btn-default btn-block" onclick = "selectHour()">10:00 - 11:00</button>
							<button type="button" class="btn btn-default btn-block" onclick = "selectHour()">11:00 - 12:00</button>
							<button type="button" class="btn btn-default btn-block" onclick = "selectHour()">12:00 - 13:00</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Martes</h4>
							<button type="button" class="btn btn-default btn-block">7:00 - 8:00</button>
							<button type="button" class="btn btn-default btn-block">8:00 - 9:00</button>
							<button type="button" class="btn btn-default btn-block">9:00 - 10:00</button>
							<button type="button" class="btn btn-default btn-block">10:00 - 11:00</button>
							<button type="button" class="btn btn-default btn-block">11:00 - 12:00</button>
							<button type="button" class="btn btn-default btn-block">12:00 - 13:00</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Miercoles</h4>
							<button type="button" class="btn btn-default btn-block">7:00 - 8:00</button>
							<button type="button" class="btn btn-default btn-block">8:00 - 9:00</button>
							<button type="button" class="btn btn-default btn-block">9:00 - 10:00</button>
							<button type="button" class="btn btn-default btn-block">10:00 - 11:00</button>
							<button type="button" class="btn btn-default btn-block">11:00 - 12:00</button>
							<button type="button" class="btn btn-default btn-block">12:00 - 13:00</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Jueves</h4>
							<button type="button" class="btn btn-default btn-block">7:00 - 8:00</button>
							<button type="button" class="btn btn-default btn-block">8:00 - 9:00</button>
							<button type="button" class="btn btn-default btn-block">9:00 - 10:00</button>
							<button type="button" class="btn btn-default btn-block">10:00 - 11:00</button>
							<button type="button" class="btn btn-default btn-block">11:00 - 12:00</button>
							<button type="button" class="btn btn-default btn-block">12:00 - 13:00</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Viernes</h4>
							<button type="button" class="btn btn-default btn-block">7:00 - 8:00</button>
							<button type="button" class="btn btn-default btn-block">8:00 - 9:00</button>
							<button type="button" class="btn btn-default btn-block">9:00 - 10:00</button>
							<button type="button" class="btn btn-default btn-block">10:00 - 11:00</button>
							<button type="button" class="btn btn-default btn-block">11:00 - 12:00</button>
							<button type="button" class="btn btn-default btn-block">12:00 - 13:00</button>
						</div>
						<div class="col-sm-2" data-toggle="button">
							<h4>Sábado</h4>
							<button type="button" class="btn btn-default btn-block">7:00 - 8:00</button>
							<button type="button" class="btn btn-default btn-block">8:00 - 9:00</button>
							<button type="button" class="btn btn-default btn-block">9:00 - 10:00</button>
							<button type="button" class="btn btn-default btn-block">10:00 - 11:00</button>
							<button type="button" class="btn btn-default btn-block">11:00 - 12:00</button>
							<button type="button" class="btn btn-default btn-block">12:00 - 13:00</button>
						</div>
						<div class="col-sm-6 col-md-offset-3">
							<button type="submit" id="BtnSave" class="btn btn-primary btn-block">
								GUARDAR
							</button>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
	</div>
</div>
@stop
@section('styles')
@stop
@section('scripts')
<script type="text/javascript">
	function selectHour() {
		console.log('Seleccionado');
	}
</script>
@stop