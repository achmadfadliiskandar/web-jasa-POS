@extends('template.master')
@section('title','Form Tambah Pengguna')
@section('judul','Tambah Pengguna Baru')
@section('menuactive','Tambah Pengguna')
@section('content')
<form action="{{ url('admin-storeuser') }}" method="POST">
    @csrf
    <!-- Input Name -->
    <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan nama" value="{{old('name')}}">
    </div>
    <!-- Input Email -->
    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="Masukan email">
    </div>
    <!-- Select Role -->
    <div class="form-group mb-3">
        <label for="role">Role</label>
        <select class="form-control" id="role" name="role">
            <option value="member">Member</option>
            <option value="guest">Guest</option>
        </select>
    </div>
    <!-- Input Password -->
    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukan password">
    </div>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
</form>
@endsection