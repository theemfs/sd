@extends('layouts.app')

@section('libraries')
<link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet" type='text/css'>
<link href="https://cdn.datatables.net/colreorder/1.3.0/css/colReorder.dataTables.min.css" rel="stylesheet" type='text/css'>
<!-- <link href="https://cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css" rel="stylesheet" type='text/css'> -->
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/colreorder/1.3.0/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
<!-- <script src="//cdn.datatables.net/buttons/1.1.0/js/buttons.colVis.min.js"></script> -->
@endsection

@section('title', "$title")

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">
			{{ $title }}
			<a href="{{ action('PerformersController@create') }}" class="btn btn-xs btn-default btn-fab pull-right"><i class="material-icons"></i>+</a>
			<a href="{{ action('PerformersController@index') }}" class="btn btn-xs btn-default btn-fab pull-right"><i class="material-icons"></i>@</a>
			<div class="dropdown pull-right">
				<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Columns
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dLabel">
					<li><a href="#" class="toggle-vis" data-column="0">id</a></li>
					<li><a href="#" class="toggle-vis" data-column="1">created_at</a></li>
					<li><a href="#" class="toggle-vis" data-column="2">updated_at</a></li>
					<li><a href="#" class="toggle-vis" data-column="3">deleted_at</a></li>
					<li><a href="#" class="toggle-vis" data-column="4">comment</a></li>
					<li><a href="#" class="toggle-vis" data-column="5">is_deleted</a></li>
					<li><a href="#" class="toggle-vis" data-column="6">name</a></li>
					<li><a href="#" class="toggle-vis" data-column="7">phone</a></li>
					<li><a href="#" class="toggle-vis" data-column="8">email</a></li>
					<li><a href="#" class="toggle-vis" data-column="9">groups</a></li>
					<li><a href="#" class="toggle-vis" data-column="10">types</a></li>
					<li><a href="#" class="toggle-vis" data-column="11">price</a></li>
					<li><a href="#" class="toggle-vis" data-column="12">size</a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
			<div class="">

				<table id="example" class="table table-bordered table-condensed table-hover table-striped" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>id</th>
							<th>created_at</th>
							<th>updated_at</th>
							<th>deleted_at</th>
							<th>comment</th>
							<th>is_deleted</th>
							<th>name</th>
							<th>phone</th>
							<th>email</th>
							<th>groups</th>
							<th>types</th>
							<th>price</th>
							<th>size</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>id</th>
							<th>created_at</th>
							<th>updated_at</th>
							<th>deleted_at</th>
							<th>comment</th>
							<th>is_deleted</th>
							<th>name</th>
							<th>phone</th>
							<th>email</th>
							<th>groups</th>
							<th>types</th>
							<th>price</th>
							<th>size</th>
						</tr>
					</tfoot>
					<tbody>
					@foreach ($performers as $performer)
						<tr>
							<th><a href="/performers/{{ $performer->id }}">{{ $performer->id }}</a></th>
							<th>{{ $performer->created_at }}</th>
							<th>{{ $performer->updated_at }}</th>
							<th>{{ $performer->deleted_at }}</th>
							<th>{{ $performer->comment }}</th>
							<th>{{ $performer->is_deleted }}</th>
							<th>{{ $performer->name }}</th>
							<th>{{ $performer->phone }}</th>
							<th>{{ $performer->email }}</th>
							<th>{{ $performer->groups }}</th>
							<th>{{ $performer->types }}</th>
							<th>{{ $performer->price }}</th>
							<th>{{ $performer->size }}</th>
						</tr>
					@endforeach
					</tbody>

				</table>
			</div>
		</div>
	</div>

<script>
	// $(document).ready(function() {

	// 	// Setup - add a text input to each footer cell
	// 	$('#example thead th').each( function () {
	// 		var title = $(this).text();
	// 		$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
	// 	} );

	// 	// DataTable
	// 	var table = $('#example').show().DataTable({
	// 		"paging":   true,
	// 		"ordering": true,
	// 		"info":     true,
	// 		// "scrollY": 	"500px",
	// 		// "scrollCollapse": true
	// 		"lengthMenu": [[5, 10, 25, 50, 100, 500, -1], [5, 10, 25, 50, 100, 500, "Все"]],
	// 		"language": {
	// 			"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
	// 		},
	// 	});

	// 	// Apply the search
	// 	table.columns().every( function () {
	// 		var that = this;

	// 		$( 'input', this.footer() ).on( 'keyup change', function () {
	// 			if ( that.search() !== this.value ) {
	// 				that
	// 					.search( this.value )
	// 					.draw();
	// 			}
	// 		} );
	// 	} );
	// });

	$(document).ready(function() {
		// Setup - add a text input to each footer cell
		$('#example thead th').each( function () {
			var title = $(this).text();
			//$(this).append( '<br><input type="text" placeholder="search '+title+'" />' );
		} );

		// DataTable
		var table = $('#example').show().DataTable({
			"lengthMenu": [[5, 10, 25, 50, 100, 500, -1], [5, 10, 25, 50, 100, 500, "All"]],
			// dom: 'Bfrtip',
			stateSave: true,
			colReorder: true,
			// fixedHeader: true,
			// select: 'multi',
			// iDisplayLength: 100,
			// buttons: [
			// 	{
			// 		"extend": 'colvis',
			// 		"collectionLayout": 'fixed two-column',
			// 		"postfixButtons": [ 'colvisRestore' ]
			// 	}
			// ]
		});

		// Apply the search
		// table.columns().every( function () {
		// 	var that = this;

		// 	$( 'input', this.header() ).on( 'keyup change', function () {
		// 		if ( that.search() !== this.value ) {
		// 			that
		// 				.search( this.value )
		// 				.draw();
		// 		}
		// 	} );
		// } );

		$('a.toggle-vis').on( 'click', function (e) {
			e.preventDefault();
			// Get the column API object
			var column = table.column( $(this).attr('data-column') );
			console.log(column);

			// Toggle the visibility
			column.visible( ! column.visible() );
		} );

	});

</script>

@endsection