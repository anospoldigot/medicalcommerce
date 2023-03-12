@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">User</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a>
            </li>
            <li class="breadcrumb-item active">Create
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create User</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" id="create-user">
                @csrf
                
                <div class="text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary"><i data-feather='corner-up-left'></i> Batal</a>
                    <button type="button" id="form-submit" class="btn btn-primary"><i data-feather='save'></i> Tambah</button>
                    <button type="submit" class="btn btn-primary d-none"><i data-feather='save'></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    
@endpush