@extends('layout')
@section('content')
<div class="container">
	<div class="row text-center">
		<h1>Reportes de Asistencia</h2>
	</div>
	<hr>
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
				<tr>
					<td>Lunes 10 de Enero 2016</td>
					<td>Castañeda Perez Mario Jose</td>
					<td>S/.20.00</td>
					<td>
						<button type="button" class="btn btn-default">
							Ver
						</button>
					</td>
				</tr>
				<tr>
					<td>Lunes 10 de Enero 2016</td>
					<td>Castañeda Perez Mario Jose</td>
					<td>S/.20.00</td>
					<td>
						<button type="button" class="btn btn-default">
							Ver
						</button>
					</td>
				</tr>
				<tr>
					<td>Lunes 10 de Enero 2016</td>
					<td>Castañeda Perez Mario Jose</td>
					<td>S/.20.00</td>
					<td>
						<button type="button" class="btn btn-default">
							Ver
						</button>
					</td>
				</tr>
				<tr>
					<td>Lunes 10 de Enero 2016</td>
					<td>Castañeda Perez Mario Jose</td>
					<td>S/.20.00</td>
					<td>
						<button type="button" class="btn btn-default">
							Ver
						</button>
					</td>
				</tr>
				<tr>
					<td>Lunes 10 de Enero 2016</td>
					<td>Castañeda Perez Mario Jose</td>
					<td>S/.20.00</td>
					<td>
						<button type="button" class="btn btn-default">
							Ver
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@stop
@section('styles')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
@stop
@section('scripts')
<script type="text/javascript" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#AssistanceTable').DataTable();
	});
</script>
@stop