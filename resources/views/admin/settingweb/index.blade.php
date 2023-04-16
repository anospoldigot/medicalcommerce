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
<form action="{{ route('setting.web.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengaturan Logo Website</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Logo</label>
                        <input type="file" class="form-control-file" name="logo" id="logo" onchange="loadFile(event)">
                    </div>
                    <div class="form-group">
                        <label for="">Preview </label>
                        <img src="{{ asset('upload/images/' . $config->logo) }}" id="logo-output" alt=""
                            onerror="this.onerror=null;this.src='{{ asset('source/image_not_load.jpg') }}';" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengaturan Checkout</h4>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <div class="flex-grow">
                                <h6>PPN</h6>
                                <small class="text-muted">Memungkinan user untuk bisa checkout langsung via whatsapp ( Order tidak
                                    tersimpan di database )</small>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_ppn" name="is_ppn" value="1" {{ $config->ppn > 0 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_ppn"></label>
                            </div>
                        </div>
                        <div class="form-group x" id="ppn-wrapper">
                            <input type="number" name="ppn" id="ppn" class="form-control" placeholder="Percentage" value="{{ $config->ppn }}">
                        </div>
                    </div>
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
                            <input type="checkbox" class="custom-control-input" id="is_guest_checkout" name="is_guest_checkout"
                                value="1" {{ $config->is_guest_checkout > 0 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_guest_checkout"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
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
                            <option value="">==PILIH==</option>
                            <option value="basic" @selected('basic'==$config->rajaongkir_type)>Basic</option>
                            <option value="starter" @selected('starter'==$config->rajaongkir_type)>Starter</option>
                            <option value="pro" @selected('pro'==$config->rajaongkir_type)>Pro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rajaongkir_apikey">Raja Ongkir API KEY</label>
                        <input type="text" class="form-control" name="rajaongkir_apikey" id="rajaongkir_apikey"
                            placeholder="Raja Ongkir API Key" value="{{ $config->rajaongkir_apikey }}">
                    </div>
                    <div class="my-2">
                        <h6>Pengaturan Gudang Pengiriman</h6>
                        <div class="form-group">
                            <label for="warehouseprovince">Provinsi</label>
                            <select class="form-control" id="warehouseprovince">
                                <option value="" selected disabled>==PILIH==</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="warehousecity">Kota</label>
                            <select class="form-control" id="warehousecity" disabled>
                                <option value="" selected disabled>==PILIH==</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div>
                        <div class="custom-options-checkable">
                            <label for="" class="custom-option-item">test</label>
                            <input type="checkbox" name="" class="custom-option-item-check" id="">
                        </div>
                    </div> --}}
                    <div>
                        <h6>Pengaturan COD</h6>
                        <p>
                            Pengaturan kota tujuan untuk pengiriman COD ( Kosongkan untuk menonaktifkan )
                        </p>
                        <div class="form-group">
                            <label for="codprovince">Provinsi</label>
                            <select class="form-control" id="codprovince">
                                <option value="" selected disabled>==PILIH==</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="codcity">Kota</label>
                            <select class="form-control" id="codcity" disabled>
                                <option value="" selected disabled>==PILIH==</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            placeholder="Tripay Merchant Code" value="{{ $config->tripay_merchant_code }}">
                    </div>
                    <div class="form-group">
                        <label for="tripay_mode">Tripay API KEY</label>
                        <input type="text" class="form-control" name="tripay_mode" id="tripay_mode"
                            placeholder="Tripay API KEY" value="{{  $config->tripay_mode}}">
                    </div>
                    <div class="form-group">
                        <label for="tripay_private_key">Tripay PRIVATE KEY</label>
                        <input type="text" class="form-control" name="tripay_private_key" id="tripay_private_key"
                            placeholder="Tripay PRIVATE KEY" value="{{ $config->tripay_private_key }}">
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
    const params = { headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }
        Dropzone.autoDiscover = false;

        // $(function() {
        //     var myDropzone = new Dropzone("#my-dropzone", {
        //         url: "{{ route('upload') }}",
        //         maxFilesize: 2,
        //         addRemoveLinks: true,
        //         acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //         headers: {
        //             'X-CSRF-TOKEN': "{{ csrf_token() }}"
        //         },
        //         init: function () {
        //             var dzClosure = this;

        //             this.on("success", function (file, response) {
        //                 console.log(response);
        //             });

        //             this.on("removedfile", function (file) {
        //                 $.ajax({
        //                     type: 'POST',
        //                     url: '{{ route('deleteUpload') }}',
        //                     data: {
        //                         filename: file.name,
        //                         _token: "{{ csrf_token() }}"
        //                     },
        //                     success: function (data) {
        //                         console.log(data);
        //                     },
        //                     error: function (e) {
        //                         console.log(e);
        //                     }
        //                 });
        //             });
        //         }
        //     });
        // });
        $('#warehouseprovince').select2({
            ajax: {
                url: '{{ route("getProvince") }}',
                dataType: 'json',
                params,
                processResults: function (data) {
                    return {
                        results: data.results.map(value => ({ id: value.province_id, text: value.province }))
                    };
                }
            }
        });


        $('#warehouseprovince').change(function(){
            if($(this).val() == ""){
                $('#warehousecity').prop('disabled', true)
            }else{
                $('#warehousecity').prop('disabled', false)
            }
        })

        $('#warehousecity').select2({
            ajax: {
                url: function (params) {
                    let url = '{{ route("getCity", ":id") }}'
                    return url.replace(":id", $('#warehouseprovince').val());
                },
                dataType: 'json',
                params,
                processResults: function (data) {
                    return {
                        results: data.results.map(value => ({ id: value.city_id, text: value.city_name }))
                    };
                }
            }
        });


        $('#codprovince').select2({
            ajax: {
                url: '{{ route("getProvince") }}',
                dataType: 'json',
                params,
                processResults: function (data) {
                    return {
                        results: data.results.map(value => ({ id: value.province_id, text: value.province }))
                    };
                }
            }
        });


        $('#codprovince').change(function(){
            if($(this).val() == ""){
                $('#codcity').prop('disabled', true)
            }else{
                $('#codcity').prop('disabled', false)
            }
        })

        $('#codcity').select2({
            ajax: {
                url: function (params) {
                    let url = '{{ route("getCity", ":id") }}'
                    return url.replace(":id", $('#codprovince').val());
                },
                dataType: 'json',
                params,
                processResults: function (data) {
                    return {
                        results: data.results.map(value => ({ id: value.city_id, text: value.city_name }))
                    };
                }
            }
        });

        var loadFile = function(event) {
            var output = document.getElementById('logo-output');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        
        @empty($config->ppn)
            $('#ppn-wrapper').hide();
        @endif

        $('#is_ppn').change(function(){
            if($(this).is(':checked')){
                $('#ppn-wrapper').show();
            }else{
                $('#ppn-wrapper').hide();
            }
        })
</script>
@endpush