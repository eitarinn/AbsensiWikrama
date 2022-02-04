@extends('layout.studentMaster')

@section('content')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-right">
				<a class="btn btn-info btn-lg" href="{{ url('/asStudent') }}">Back</a>
			</div>
		</div>
	</div>
	<br>
	<table class="table table-bordered">
	<thead class="table-primary">
		<tr>
			<th class="text-center">Jam Kedatangan</th>
			<th class="text-center">Jam Kepulangan</th>
		</tr>
	</thead>
		<tr>
            @if(session()->has('sampai'))
            <form action="{{ route('presents.store') }}" method="POST">
            @csrf
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('sampai') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <input type="hidden" value="{{ Auth::user()->nama }}" name="nis">
                <input type="hidden" name="keterangan" value="Hadir">
                <td>
                    <div class="text-center">
                        <button type="submit" name="btnIn" class="btn btn-primary btn-danger" disabled>Datang</button>
                    </div>
                </td>
                <td>
                    <div class="text-center">
                        <button type="submit" name="btnOut" class="btn btn-primary btn-danger">Pulang</button>
                    </div>
                </td>
            </form>

           @elseif(session()->has('pulang')) 
           <form action="{{ route('presents.store') }}" method="POST">
            @csrf
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('pulang') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <input type="hidden" value="{{ Auth::user()->nama }}" name="nis">
            <input type="hidden" value="Hadir" name="keterangan">
            <td>
                <div class="text-center">
                    <button type="submit" name="btnIn" class="btn btn-primary btn-danger" disabled>Datang</button>
                </div>
            </td>
            <td>
                <div class="text-center">
                    <button type="submit" name="btnOut" class="btn btn-primary btn-danger" disabled>Pulang</button>
                </div>
            </td>
           </form>

           @else 
           <form action="{{ route('presents.store') }}" method="POST">
            @csrf
            <input type="hidden" name="nis" value="{{ Auth::user()->nama }}">
            <input type="hidden" value="Hadir" name="keterangan">
            <td>
                <div class="text-center">
                    <button type="submit" name="btnIn" class="btn btn-primary btn-danger">Datang</button>
                </div>
            </td>
            <td>
                <div class="text-center">
                    <button type="submit" name="btnOut" class="btn btn-primary btn-danger" disabled>Pulang</button>
                </div>
            </td>
           </form>
           @endif
		</tr>
</table>
</body>
</html>
@endsection