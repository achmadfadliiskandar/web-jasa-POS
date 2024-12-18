@extends('template.master')

@section('title', 'Detail Data User')
@section('judul', 'Profile User')
@section('menuactive', 'Profile User')

@section('content')
    <div class="row">
        <div class="col-xl-8">
            {{-- profile admin --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Identitas User</h5>
                    <form action="{{ url('admin-updateuser/' . $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="username"
                                value="{{ $users->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $users->email }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="member" @selected($users->role == 'member')>Member</option>
                                <option value="guest" @selected($users->role == 'guest')>Guest</option>
                            </select>
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
                    <img src="{{ asset('NiceAdmin/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                    <h2>{{ $users->name }}</h2>
                    <h3>{{ $users->role }}</h3>
                    <div class="social-links mt-2">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <a href="{{ url('/admin-datauser') }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    @endsection
