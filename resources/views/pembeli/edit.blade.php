@extends('pembeli.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data pembeli</h5>

		<form method="post" action="{{ route('pembeli.update', $data->id_pembeli) }}">
			@csrf
            <div class="mb-3">
                <label for="id_pembeli" class="form-label">ID Pembeli</label>
                <input type="text" class="form-control" id="id_pembeli" name="id_pembeli" value="{{ $data->id_pembeli }}">
            </div>
			<div class="mb-3">
                <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" value="{{ $data->nama_pembeli }}">
            </div>
            <div class="mb-3">
                <label for="alamat_pembeli" class="form-label">Alamat Pembeli</label>
                <input type="text" class="form-control" id="alamat_pembeli" name="alamat_pembeli" value="{{ $data->alamat_pembeli }}">
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" value="{{ $data->id_barang }}">
            </div>
            <div class="mb-3">
                <label for="id_ekspedisi" class="form-label">ID Ekpedisi</label>
                <input type="text" class="form-control" id="id_ekspedisi" name="id_ekspedisi" value="{{ $data->id_ekspedisi }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop