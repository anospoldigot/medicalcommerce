@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1
])


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

@section('content')
<div class="container py-5">
    <h1 class="mb-3">Profile</h1>
    <div class="bg-white p-4" style="border-radius: 12px;">
        <form action="{{ route('fe.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option selected disabled>==Pilih==</option>
                            <option value="laki laki" @selected($user->gender == 'laki laki')>Laki Laki</option>
                            <option value="perempuan" @selected($user->gender == 'perempuan')>Perempuan</option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        <small>Note: Kosongkan jika anda tidak ingin mengganti password</small>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password Confirm</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                <div class="col-4 order-0 order-lg-1">
                    <div class="p-5">
                        <div class="profile-pic">
                            <label class="-label" for="file">
                                <span class="glyphicon glyphicon-camera"></span>
                                <span>Change Image</span>
                            </label>
                            <input id="file" type="file" onchange="loadFile(event)" name="profile" />
                            <img src="{{ asset('upload/images/' . $user->profile) }}" id="output" width="200" class="mb-3" />
                        </div>
                        @error('profile')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp"
                            alt="profile-user" class="rounded-circle mb-3"> --}}
                            <h6 class="text-center">{{ $user->name }}</h6>
                    </div>
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