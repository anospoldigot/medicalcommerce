@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">Setting
            </li>
            <li class="breadcrumb-item active">Store
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<form action="{{ route("setting.store.update") }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Logo</h4>
                </div>
                <div class="card-body">
                    <input type="file" name="logo" id="logo">
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengaturan Toko</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Toko</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="name@example.com"
                            value="{{ $shop->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nomor Whatsapp</label>
                        <input type="number" class="form-control" id="name" name="phone" placeholder="name@example.com"
                            value="{{ $shop->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Toko</label>
                        <textarea class="form-control" id="description" rows="3" name="description">{{ $shop->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="editor">Alamat tampilan toko</label>
                        <textarea class="form-control" id="editor" name="address">{!! $shop->address !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-1 text-right">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection

@push('scripts')
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                ]
            },
        });
    </script>
@endpush