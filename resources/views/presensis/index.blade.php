@extends('layout.master')

@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Data Presensi</h2>
			</div>
            <div class="pull-right">
				<a class="btn btn-success" href="{{ route('presensis.create') }}">Create</a>
			</div>
		</div>
	</div>
	<br>

    @if(session()->has('sudah absen'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('sudah absen') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session()->has('absentSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('absentSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session()->has('tidak bisa edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('tidak bisa edit') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session()->has('berhasil edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('berhasil edit') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session()->has('berhasil hapus'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('berhasil hapus') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session()->has('absentSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('absentSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<table class="table table-bordered">
	<tr>
		<th>No</th>
        <th>Tanggal</th>
		<th>NIS</th>
        <th>Jam Kedatangan</th>
        <th>Jam Kepulangan</th>
        <th>Keterangan</th>
		<th width="280px">Action</th>
	</tr>
	@foreach($presensis as $presensi)
	<tr>
		<td>{{ ++$i }}</td>
        <td>{{ $presensi->tanggal }}</td>
		<td>{{ $presensi->nis }}</td>
        <td>{{ $presensi->jam_kedatangan }}</td>
        <td>{{ $presensi->jam_kepulangan }}</td>
        <td>{{ $presensi->keterangan }}</td>
		<td>
			<form action="{{ route('presensis.destroy',$presensi->id) }}" method="POST">
				<a class="btn btn-primary" href="{{ route('presensis.edit',$presensi->id) }}">Edit</a>
                <a class="btn btn-primary" href="{{ route('presensis.show',$presensi->id) }}">Detail</a>

				@csrf
				@method('DELETE')

				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		</td>
	</tr>
	@endforeach
</table>
{!! $presensis->links() !!}
@endsection