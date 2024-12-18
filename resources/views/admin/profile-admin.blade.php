@extends('template.master')

@section('title','Detail Data Admin')
@section('judul','Profile Admin')
@section('menuactive','Profile Admin')

@section('content')
<div class="row">
  <div class="col-xl-8">
    {{-- profile admin --}}
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Identitas Admin</h5>
    <form action="{{url('admin-editprofile/'.$user->id)}}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="username" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="username" value="{{$user->name}}">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
      </div>
      <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
  </div>
</div>
{{-- profile admin --}}
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Ubah Password</h5>
    <form>
      <div class="mb-3">
        <label for="currentPassword" class="col-form-label">Current Password</label>
          <input name="password" type="password" class="form-control" id="currentPassword">
        </div>
      <div class="mb-3">
        <label for="newPassword" class="col-form-label">New Password</label>
          <input name="newpassword" type="password" class="form-control" id="newPassword">
        </div>
      <div class="mb-3">
        <label for="renewPassword" class="col-form-label">Re-enter New Password</label>
          <input name="renewpassword" type="password" class="form-control" id="renewPassword">
        </div>
        <button type="submit" class="btn btn-success w-100">Change Password</button>
    </form>
  </div>
</div>
{{-- password admin --}}
  </div>
  <div class="col-xl-4">
    <div class="card">
      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <img src="{{asset('NiceAdmin/assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
        <h2>{{Auth::user()->name}}</h2>
        <h3>{{Auth::user()->role}}</h3>
        <div class="social-links mt-2">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
      <a href="{{url('/dashboard')}}" class="btn btn-warning">Back</a>
    </div>
</div>
@endsection