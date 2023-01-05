@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">Setting
            </li>
            <li class="breadcrumb-item active">My Account
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<form action="{{ route("user.update") }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Akun Saya</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder=""
                            value="{{ $user->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email " name="email" placeholder=""
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">No. Ponsel</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder=""
                            value="{{ $user->phone }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"" id="password" name="password" placeholder=""
                           >
                        @error('password') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            <small class="text-muted">Note: Kosongkan jika tidak ingin mengganti password</small>
                    </div>
                        <label for="password_confirmation">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder=""
                           >
                    </div>
 
                    <div class="my-1 text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

