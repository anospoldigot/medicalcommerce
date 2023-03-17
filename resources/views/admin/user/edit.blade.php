@extends('layouts.app')

@push('styles')
    <style>
            .profile-pic {
                color: transparent;
                transition: all 0.3s ease;
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
                transition: all 0.3s ease;
            }
        
            .profile-pic input {
                display: none;
            }
        
            .profile-pic img {
                position: absolute;
                object-fit: cover;
                width: 165px;
                height: 165px;
                box-shadow: 0 0 10px 0 rgba(255, 255, 255, 0.35);
                border-radius: 100px;
                z-index: 0;
            }
        
            .profile-pic .-label {
                cursor: pointer;
                height: 165px;
                width: 165px;
            }
        
            .profile-pic:hover .-label {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: rgba(0, 0, 0, 0.8);
                z-index: 10000;
                color: #fafafa;
                transition: background-color 0.2s ease-in-out;
                border-radius: 100px;
                margin-bottom: 0;
            }
        
            .profile-pic span {
                display: inline-flex;
                padding: 0.2em;
                height: 2em;
            }
    </style>
@endpush

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">User</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a>
            </li>
            <li class="breadcrumb-item active">Edit
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-12 col-lg-8 row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    placeholder="Name" value="{{ $user->name }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                    placeholder="Email" value="{{ $user->email }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                    placeholder="phone" value="{{ $user->phone }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option selected disabled>==Pilih==</option>
                                    <option value="laki laki">Laki Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                    placeholder="password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirm</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation" placeholder="password_confirmation">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <h6>Address Form</h6>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address[]" placeholder="address">
                        </div>
                    </div> --}}
                    <div class="col-12 col-lg-4">
                        <div class="p-5">
                            <div class="profile-pic">
                                <label class="-label" for="file">
                                    <span class="glyphicon glyphicon-camera"></span>
                                    <span>Change Image</span>
                                </label>
                                <input id="file" type="file" onchange="loadFile(event)" name="profile" class="" />
                                <img src="{{ asset('upload/images/' . $user->profile) }}" id="output" width="200" class="mb-3" />
                            </div>
                            @error('profile')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp" alt="profile-user"
                                class="rounded-circle mb-3"> --}}
                            <h6 class="text-center">{{ $user->name }}</h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary"><i data-feather='corner-up-left'></i>
                            Back
                        </a>
                        <button type="submit" id="form-submit" class="btn btn-primary"><i data-feather='save'></i> Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var loadFile = function (event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
