@extends('penjual.layout')

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

        <h5 class="card-title fw-bolder mb-3">Ubah Data penjual</h5>

		<form method="post" action="{{ route('penjual.update', $data->id_penjual) }}">
			@csrf
            <div class="mb-3">
                <label for="id_penjual" class="form-label">ID Penjual</label>
                <input type="text" class="form-control" id="id_penjual" name="id_penjual" value="{{ $data->id_penjual }}">
            </div>
			<div class="mb-3">
                <label for="nama_penjual" class="form-label">Nama Penjual</label>
                <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" value="{{ $data->nama_penjual }}">
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang">
            </div>
            <div class="mb-3">
                <label for="notelp_penjual" class="form-label">Notelp Penjual</label>
                <input type="text" class="form-control" id="notelp_penjual" name="notelp_penjual" value="{{ $data->notelp_penjual }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
		</form>
	</div>
</div>

@stop