@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Coupon</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">Coupon</a>
            </li>
            <li class="breadcrumb-item active">Create
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Coupon</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('coupons.store') }}" method="POST" id="create-coupon">
                    @csrf
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" name="code" value="{{ Str::random(6) }}" class="form-control" readonly @error('code') is-invalid @enderror>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount_type">Discount Type</label>
                        <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror"
                            id="discount_type">
                            <option value="" selected disabled>==PILIH==</option>
                            <option value="persen">Persen</option>
                            <option value="nominal">Nominal</option>
                        </select>
                        @error('discount_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount Value</label>
                        <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount"
                            name="discount" placeholder="Discount" value="{{ old('discount') }}">
                        @error('discount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="expire_at">Expire At</label>
                        <input type="date" class="form-control @error('expire_at') is-invalid @enderror" id="expire_at"
                            name="expire_at" placeholder="expire_at" value="{{ old('expire_at') }}">
                        @error('expire_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#discount').on('input', function(){
            if($('#discount_type').val() == 'persen'){
                const prev = $(this).data('val');
                if(event.target.value > 100){
                    event.preventDefault();
                    alert('persen tidak bisa diatas 100');
                }else{
                    const value = event.target.value.replace(/[^\d]/g, "")
                    event.target.value = value;
                }
            }else if($('#discount_type').val() == 'nominal'){
                const value = event.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                event.target.value = numeral(value).format('0,0');
            }else{
                alert('Masukkan tipe discount dahulu');
                event.target.value = '';
            }
        });
</script>
@endpush