@extends('template.master')
@section('title','Form Tambah Paket Member')
@section('judul','Tambah Paket Member Baru')
@section('menuactive','Tambah Paket Member')
@section('content')
<form action="{{ url('admin-storepaketmember') }}" method="POST">
    @csrf
    <!-- Input Name -->
    <div class="form-group mb-3">
        <label for="name">Durasi</label>
        <select class="form-control" id="durasi" name="durasi">
            <option value="1-bulan">1-Bulan</option>
            <option value="6-bulan">6-Bulan</option>
            <option value="12-bulan">12-Bulan</option>
        </select>
    </div>
    <!-- Input Email -->
    <div class="form-group mb-3">
        <label for="harga">Harga</label>
        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{old('harga')}}" placeholder="Masukan harga">
    </div>
    <!-- Select Role -->
    <div class="form-group mb-3">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="tersedia">Tersedia</option>
            <option value="tidak_tersedia">Tidak Tersedia</option>
        </select>
    </div>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
</form>
@endsection