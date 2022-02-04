@extends('layout.master')

@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Add new</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-primary" href="{{ route('presensis.index') }}">Back</a>
			</div>
		</div>
	</div>
	<br>
	@if($errors->any())
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

<form action="{{ route('presensis.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Nama</strong>
				<select class="form-control" name="nis">
					@foreach($students as $student)
					<option value="{{$student->nama}}">{{$student->nama}}</option>
					@endforeach
				</select>
			</div>
		</div>
        <div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Keterangan</strong>
				<select class="form-control" name="keterangan" required>
					<option value="Tidak hadir karena Sakit">Sakit</option>
					<option value="Tidak hadir karena Izin">Izin</option>				
				</select>
			</div>
		</div>
        <div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Bukti</strong>
				<input type="file" name="foto" class="form-control" placeholder="Bukti" required>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
</form>
@endsection