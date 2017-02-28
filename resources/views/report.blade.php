@extends('layout')
@section('content')
<div class="container">
	<div class="row text-center">
		<h1>Reportes de Asistencia</h2>
	</div>
	<hr>
	<div class="row" style="margin-bottom: 30px">
		<div class="col-xs-4">
			<select class="js-example-basic-single" style="width: 100%">
				<option value="0">Elija un Trabajador</option>
			    <option value="AL">Alabama</option>
			        ...
			    <option value="WY">Wyoming</option>
			</select>
		</div>
		<div class="col-xs-1" style="text-align: right;">
			<label>Fecha Inicio</label>
		</div>
		<div class="col-xs-3">
			<div class="input-group date" data-provide="datepicker" id="dateOne">
			    <input type="text" name = "init_date" class="form-control">
			    <div class="input-group-addon">
			        <span class="glyphicon glyphicon-calendar"></span>
			    </div>
			</div>
		</div>
		<div class="col-xs-1" style="text-align: right;">
			<label>Fecha Termino</label>
		</div>
		<div class="col-xs-3">
			<div class="input-group date" data-provide="datepicker" id="dateTwo">
			    <input type="text" name = "end_date"class="form-control">
			    <div class="input-group-addon">
			        <span class="glyphicon glyphicon-calendar"></span>
			    </div>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="display" cellspacing="0" width="100%" id="AssistanceTable">
			<thead>
				<tr>
					<th>Día</th>
					<th>Trabajador</th>
					<th>Descuento</th>
					<th>Detalles</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($reports as $report)
				<tr>
					<td>{{ $report -> created_at }}</td>
					<td>{{ $report -> name }}</td>
					<td>{{ $report -> discount }}</td>
					<td>
						<button type="button" class="btn btn-default">
							Ver
						</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="col-md-12" style="text-align: right;">
			{{ $reports->links() }}
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<button type="button" class="btn btn-primary">Generar Total</button>
		</div>
		<label class="col-md-4 control-label"></label>
	</div>
</div>
@stop
@section('styles')
<link rel="stylesheet" type="text/css" href="/css/libs.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
@stop
@section('scripts')
<script type="text/javascript" src="/js/libs.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
$(".js-example-basic-single").select2();
	$.fn.datepicker.dates['es'] = {
	    days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
	    daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
	    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
	    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
	    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
	    today: "Hoy",
	    clear: "Limpiar",
	    format: "mm/dd/yyyy",
	    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
	    weekStart: 0
	};
	$('#dateOne').datepicker({
		language: 'es',
	    format: 'dd/mm/yyyy',
	    autoclose: 'true'
	});
	$('#dateTwo').datepicker({
		language: 'es',
	    format: 'dd/mm/yyyy',
	    autoclose: 'true'
	});
	$('#AssistanceTable').DataTable({
			"searching": false,
			"paginate": false,
			"info": false,
			"legend": false,
	    	"language": {
	            "lengthMenu": "Ver _MENU_ registros por página",
	            "sSearch": "Buscar:",
	            "Processing": "Procesando",
	            "zeroRecords": "No se encontraron resultados",
	            "info": "Página _PAGE_ de _PAGES_",
	            "infoEmpty": "No hay registros disponibles",
	            "infoFiltered": "(Filtrado de  _MAX_ registros totales)",
	            "oPaginate": {
			        "sFirst":    "Primero",
			        "sLast":     "Último",
			        "sNext":     "Siguiente",
			        "sPrevious": "Anterior"
    			}
        	}
	    });
</script>
@stop