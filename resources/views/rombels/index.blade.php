@extends('layout.master')

@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Data Rombel</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-success" href="{{ route('rombels.create') }}">Create</a>
			</div>
		</div>
	</div>
	<br>
	@if($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif

<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>Nama Rombel</th>
		<th width="280px">Action</th>
	</tr>
	@foreach($rombels as $rombel)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $rombel->rombel }}</td>
		<td>
			<form action="{{ route('rombels.destroy',$rombel->id) }}" method="POST">
				<a class="btn btn-primary" href="{{ route('rombels.edit',$rombel->id) }}">Edit</a>

				@csrf
				@method('DELETE')

				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		</td>
	</tr>
	@endforeach
</table>
{!! $rombels->links() !!}
@endsection