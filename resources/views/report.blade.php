@extends('layout')
@section('content')
<div class="container">
	<div class="row text-center">
		<h1>Reportes de Asistencia</h2>
	</div>
	<hr>
	<div class="row" style="margin-bottom: 30px">
		<div class="col-xs-4">
			<select id="UserSelect" class="js-example-basic-single" style="width: 100%">
			<option id="0">Seleccione un Trabajador</option>
			</select>
		</div>
		<div class="col-xs-1" style="text-align: right;">
			<label>Fecha Inicio</label>
		</div>
		<div class="col-xs-3">
			<div class="input-group date" data-provide="datepicker" id="dateOne">
			    <input id="InitDate" type="text" name = "init_date" class="form-control">
			    <input type="hidden" id="date_init">
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
			    <input id="EndDate" type="text" name = "end_date" class="form-control">
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
					<th>Entrada</th>
					<th>Dscto.</th>
                    <th>Salida</th>
                    <th>Dscto.</th>
                    <th>Trabajador</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="row">
		<div class="col-md-4">
			<button type="button" class="btn btn-primary" id="TotalButton">Generar Total</button>
		</div>
		<input type="text" class="col-md-4 form-control total-input" id="TotalDiscount" disabled="disabled"/>
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
	$('#TotalButton').on("click", function(){
		$.ajax({
			type: 'GET',
			url:'reporte/total',
			data: {
				id : $('#UserSelect').val(),
				init_date : $('#InitDate').val(),
				end_date : $('#EndDate').val()
			}
		}).then(function(data) {
			console.log(data);
			$('#TotalDiscount').val(data);
		});
	});
	var url = "/reporte/personal";

	var table = $('#AssistanceTable').DataTable({
		"processing": true,
		"serverSide": true,
        "ajax": {
			url: '/reporte/personal',
			data: function(d){
				d.id = $('#UserSelect').val();
				d.init_date = $('#InitDate').val();
				d.end_date = $('#EndDate').val();
			}
		},
        "columns": [
            {data:'entry', name: 'assists.entry'},
            {data:'discount_entry', name: 'assists.discount_entry'},
            {data:'exit', name: 'assists.exit'},
            {data:'discount_exit', name: 'assists.discount_exit'},
            {data:'name', name: 'personal.name'}
        ],
		"searching": false,
		"info": false,
		"legend": false,
    	"language": {
            "lengthMenu": "Ver _MENU_ registros por página",
            "sSearch": "Buscar:",
            "sProcessing": "Procesando",
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
	
	$(".js-example-basic-single").on("select2:select", function(e) {	
		table.draw();
		/*
		$.ajax ({
			type: "GET",
			url: "reporte/personal",
			data: {
				id: id
			},
			success: function (data) {
				console.log('hola');
				var link = url+'?id='+id;
				table.ajax.url = link;
				table.ajax.reload();
			}
		});
		*/
	});
	$.ajax({
		type: 'GET',
		url:'reporte/data',
		dataType: 'json'
	}).then(function(data) {
		for(var i in data) {
			var newOption = new Option(data[i].name, data[i].id, true, true);
			$(".js-example-basic-single").append(newOption);
		}
	});
	$(".js-example-basic-single").select2({
		placeholder: 'Seleccione un trabajador',
		allowClear: "true"
	});
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
	    format: 'yyyy-mm-dd',
	    autoclose: 'true'
	}).on('changeDate', function(){
		table.draw();
	});
	$('#dateTwo').datepicker({
		language: 'es',
	    format: 'yyyy-mm-dd',
	    autoclose: 'true'
	}).on('changeDate', function(){
		var end_date = $('#EndDate').val($('#EndDate').val()+' 23:59:59');
		table.draw();
	});
	
</script>
@stop