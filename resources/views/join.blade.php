@extends('penjual.layout')

@section('content')

<h4 class="mt-5">Online Shop</h4>

@if($message = Session::get('success'))
    <div class="alert alert-success mt-3" role="alert">
        {{ $message }}
    </div>
@endif

<form action="">
<div class="input-group mb-3">
  <input name="search" type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
</div>
</form>

<table class="table table-hover mt-2">
    <thead>
      <tr>
      <th>id</th>
        <th>Pembeli</th>
        <th>Barang</th>
        <th>Harga</th>
        <th>Penjual</th>
        <th>Ekspedisi</th>
        <th>Ongkir</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_pembeli }}</td>
                <td>{{ $data->nama_pembeli }}</td>
                <td>{{ $data->nama_barang }}</td>
                <td>{{ $data->harga_barang }}</td>
                <td>{{ $data->nama_penjual }}</td>
                <td>{{ $data->nama_ekspedisi }}</td>
                <td>{{ $data->biaya_ekspedisi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop