@extends('layout.master')

@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Edit</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-primary" href="{{ route('admins.index') }}">Back</a>
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

<form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Nama</strong>
				<input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $admin->nama }}">
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Username</strong>
				<input type="text" name="username" class="form-control" placeholder="Username" value="{{ $admin->username }}">
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Old Password</strong>
				<input type="password" name="newpassword1" class="form-control" placeholder="Password">
			</div>
		</div>
        <div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>New Password</strong>
				<input type="password" name="newpassword2" class="form-control" placeholder="Password">
			</div>
		</div>
        <input type="hidden" name='is_admin' value="admin">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>
</form>
@endsection