@extends('template.master')
@section('title','Form Edit Paket Member')
@section('judul','Edit Paket Member')
@section('menuactive','Edit Paket Member')
@section('content')
<form action="{{ url('admin-updatepaketmember/'.$paketmember->id) }}" method="POST">
    @method("PUT")
    @csrf
    <!-- Select Durasi -->
    <div class="form-group mb-3">
        <label for="name">Durasi</label>
        <select class="form-control" id="durasi" name="durasi">
            <option value="1-bulan" @selected($paketmember->durasi == '1-bulan')>1-Bulan</option>
            <option value="6-bulan" @selected($paketmember->durasi == '6-bulan')>6-Bulan</option>
            <option value="12-bulan" @selected($paketmember->durasi == '12-bulan')>12-Bulan</option>
        </select>
    </div>
    <!-- Input Price -->
    <div class="form-group mb-3">
        <label for="harga">Harga</label>
        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{$paketmember->harga}}" placeholder="Masukan harga">
    </div>
    <!-- Select Status -->
    <div class="form-group mb-3">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="tersedia" @selected($paketmember->status == 'tersedia')>Tersedia</option>
            <option value="tidak_tersedia" @selected($paketmember->durasi == 'tidak_tersedia')>Tidak Tersedia</option>
        </select>
    </div>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
</form>
<a href="{{url('admin-paketmember')}}" class="btn btn-warning my-3">Back</a>
@endsection