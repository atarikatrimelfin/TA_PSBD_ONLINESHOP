@extends('ekspedisi.layout')

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

        <h5 class="card-title fw-bolder mb-3">Tambah ekspedisi</h5>

		<form method="post" action="{{ route('ekspedisi.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_ekspedisi" class="form-label">ID Ekspedisi</label>
                <input type="text" class="form-control" id="id_ekspedisi" name="id_ekspedisi">
            </div>
			<div class="mb-3">
                <label for="nama_ekspedisi" class="form-label">Nama ekspedisi</label>
                <input type="text" class="form-control" id="nama_ekspedisi" name="nama_ekspedisi">
            </div>
            <div class="mb-3">
                <label for="biaya_ekspedisi" class="form-label">Biaya Ekspedisi</label>
                <input type="text" class="form-control" id="biaya_ekspedisi" name="biaya_ekspedisi">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop