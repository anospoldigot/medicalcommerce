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
<form action="{{ route('setting.api.update') }}" method="post">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Duitku Payment Gateway</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Pengaturan Tripay payment Gateway
                        Silahkan daftar di tripay.co.id untuk mendapatkan Kredensial</p>
                    <div class="form-group">
                        <label for="payment_mode">Duitku Environtment</label>
                        <select class="form-control" id="payment_mode" name="payment_mode">
                            <option value="dev" @selected($config->payent_mode == 'dev')>Sandbox</option>
                            <option value="prod" @selected($config->payent_mode == 'prod')>Production</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="merchant_key">Merchant Key</label>
                        <input type="text" class="form-control" id="merchant_key" name="merchant_key"
                            placeholder="Merchant Key" value="{{ $config->merchant_key }}">
                    </div>
                    <div class="form-group">
                        <label for="merchant_code">Merchant Code</label>
                        <input type="text" class="form-control" id="merchant_code" name="merchant_code"
                            placeholder="Merchant Code" value="{{ $config->merchant_code }}">
                    </div>
                    <div class="form-group">
                        <label for="return_url">Return Url</label>
                        <input type="text" class="form-control" id="return_url" name="return_url"
                            placeholder="Return URL" value="{{ $config->return_url }}">
                    </div>
                    <div class="form-group">
                        <label for="callback_url">Callback Url</label>
                        <input type="text" class="form-control" id="callback_url" name="callback_url"
                            placeholder="Callback URL" value="{{ $config->merchant_token }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ekspedisi (Biteship API)</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Pengaturan ongkir otomatis by Rajaongkir
                        Silahkan daftar di rajaongkir.com untuk mendapatkan apikey
                        starter</p>
                    <div class="form-group">
                        <label for="biteship_token">Biteship Token</label>
                        <input type="text" class="form-control" id="biteship_token" name="biteship_token"
                            placeholder="Token" value="{{ $config->biteship_token }}">
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


@push('scripts')
<script>
    // const params = { headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }

</script>
@endpush