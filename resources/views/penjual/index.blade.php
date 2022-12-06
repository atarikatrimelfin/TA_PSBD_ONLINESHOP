@extends('penjual.layout')

@section('content')

<form action="">
<div class="input-group mt-3 mb-2">
  <input name="search" type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
</div>
</form>

<h4 class="">Data penjual</h4>

<a href="{{ route('penjual.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>ID Penjual</th>
        <th>Nama Penjual</th>
        <th>ID Barang</th>
        <th>NoTelp Penjual</th>
        
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_penjual }}</td>
                <td>{{ $data->nama_penjual }}</td>
                <td>{{ $data->id_barang }}</td>
                <td>{{ $data->notelp_penjual }}</td>
                <td>
                    <a href="{{ route('penjual.edit', $data->id_penjual) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>

                 
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_penjual }}">
                        Hapus
                    </button>

                    <div class="modal fade" id="hapusModal{{ $data->id_penjual }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('penjual.delete', $data->id_penjual) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#recycle{{ $data->id_penjual }}">
                        Recycle
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="recycle{{ $data->id_penjual }}" tabindex="-1" aria-labelledby="recycleLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="recycleLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('penjual.recycle', $data->id_penjual) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<h4 class="">Recycle</h4>

<table class="table table-hover mt-2">
    <thead>
      <tr>
      <th>ID Penjual</th>
        <th>Nama Penjual</th>
        <th>ID Barang</th>
        <th>NoTelp Penjual</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datasrecycle as $data)
            <tr>
            <td>{{ $data->id_penjual }}</td>
                <td>{{ $data->nama_penjual }}</td>
                <td>{{ $data->id_barang }}</td>
                <td>{{ $data->notelp_penjual }}</td>
                <td>
                    <a href="{{ route('penjual.restore', $data->id_penjual) }}" type="button" class="btn btn-secondary rounded-3">Restore</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop