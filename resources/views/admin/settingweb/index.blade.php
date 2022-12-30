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
            <li class="breadcrumb-item active">Web
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<form action="{{ route('setting.web.update') }}" method="post">
    @csrf
    @method('PATCH')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Pengaturan Checkout</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2 ">
                <div class="flex-grow">
                    <h6>Whatsapp Checkout</h6>
                    <small class="text-muted">Memungkinan user untuk bisa checkout langsung via whatsapp ( Order tidak
                        tersimpan di database )</small>
                </div>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_whatsapp_checkout"
                        name="is_whatsapp_checkout" value="1" {{ $config->is_whatsapp_checkout > 0 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_whatsapp_checkout"></label>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="flex-grow">
                    <h6>Guest Checkout</h6>
                    <small class="text-muted">Memunginkan checkout tanpa harus login / register</small>
                </div>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_guest_checkout" name="is_guest_checkout" value="1" {{ $config->is_guest_checkout > 0 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_guest_checkout"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tripay Payment Gateway</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Pengaturan Tripay payment Gateway
                        Silahkan daftar di tripay.co.id untuk mendapatkan Kredensial</p>
                    <div class="form-group">
                        <label for="tripay_mode">Raja Ongkir Type</label>
                        <select class="form-control" id="tripay_mode" name="tripay_mode">
                            <option value="sandbox">Sandbox</option>
                            <option value="production">Production</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tripay_merchant_code">Tripay Merchant Code</label>
                        <input type="text" class="form-control" name="tripay_merchant_code" id="tripay_merchant_code"
                            placeholder="Tripay Merchant Code">
                    </div>
                    <div class="form-group">
                        <label for="tripay_mode">Tripay API KEY</label>
                        <input type="text" class="form-control" name="tripay_mode" id="tripay_mode"
                            placeholder="Tripay API KEY">
                    </div>
                    <div class="form-group">
                        <label for="tripay_private_key">Tripay PRIVATE KEY</label>
                        <input type="text" class="form-control" name="tripay_private_key" id="tripay_private_key"
                            placeholder="Tripay PRIVATE KEY">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ekspedisi</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Pengaturan ongkir otomatis by Rajaongkir
                        Silahkan daftar di rajaongkir.com untuk mendapatkan apikey
                        starter</p>
                    <div class="form-group">
                        <label for="rajaongkir_type">Raja Ongkir Type</label>
                        <select class="form-control" id="rajaongkir_type" name="rajaongkir_type">
                            <option value="basic">Basic</option>
                            <option value="starter">Starter</option>
                            <option value="Pro">Pro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rajaongkir_apikey">Raja Ongkir API KEY</label>
                        <input type="text" class="form-control" name="rajaongkir_apikey" id="rajaongkir_apikey"
                            placeholder="Raja Ongkir API Key">
                    </div>
                    <div class="form-group">
                        Pengaturan Gudang Pengiriman
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mb-4">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection