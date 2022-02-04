@extends('layout.studentMaster')

@section('content')
<form>
    @if(session()->has('sudah absen'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('sudah absen') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
     @endif
<table class="table table-bordered">
	<thead class="table-primary">
	<tr>
		<th class="text-center">HADIR</th>
		<th class="text-center">TIDAK HADIR</th>
	</tr>
	</thead>
	<tr>
		<td>
			<div class="text-center">
				<a type="submit" class="btn btn-info btn-lg" href="{{ route('presents.index') }}">HADIR</a>
			</div>
		</td>
		<td>
			<div class="text-center">
				<a type="submit" class="btn btn-warning btn-lg" href="{{ route('absents.index') }}">TIDAK HADIR</a>
			</div>
		</td>
	</tr>
</table>
</form>
@endsection