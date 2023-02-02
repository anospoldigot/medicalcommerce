@extends('layouts.frontend', [
'disableHero' => 1
])

@section('content')
<!-- Hero  -->
{{-- <div class="hero-container">
    <div class="h-100 hero-container-opacity">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-12 col-lg-6 text-secondary">
                    <div class="mb-4">
                        <span class="text-uppercase fw-600 fs-30">Permedik</h1>
                            <h6 style="">Product Kits & <span class="text-primary">Medical</span></h6>
                    </div>
                    <p class="mb-4">
                        Temukan beragam alat medis rumah sakit di permedik dengan kualkitas yang baik pengiriman
                        cepat
                    </p>
                    <button class="btn btn-primary px-3">Shop Now</button>
                </div>
                <div class="col-12 col-lg-6">
                    <img src="{{ asset('frontend/img/hero.svg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light text-center py-2">
    <span style="font-weight: 900; font-size: 40px; color: #b4b6b8;">PERMATA MITRA MEDIKA</span>
</div> --}}
<div style="background: #7158e226">
    <div class="container py-5">
        <div class="card border-0">
            <!-- Product Details starts -->
            <div class="card-body">
                <form action="{{ url('requestEWallet') }}" method="post" id="checkout">
                    @csrf
                    <input type="hidden" name="referenceNo" value="{{ uniqid('ORD-', true) }}" />
                    <input type="hidden" name="amt" value="{{ $order_subtotal + 10000 }}" id="amt" />
                    <div class="px-4 px-lg-0">
                        <div class="pb-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 p-5 bg-white rounded mb-5">

                                        <!-- Shopping cart table -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="border-0 bg-light">
                                                            <div class="p-2 px-3 text-uppercase">Product</div>
                                                        </th>
                                                        <th scope="col" class="border-0 bg-light">
                                                            <div class="py-2 text-uppercase">Price</div>
                                                        </th>
                                                        <th scope="col" class="border-0 bg-light">
                                                            <div class="py-2 text-uppercase">Quantity</div>
                                                        </th>
                                                        <th scope="col" class="border-0 bg-light">
                                                            <div class="py-2 text-uppercase">Remove</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($carts as $cart)
                                                    <tr data-product="{{ json_encode($cart->product) }}">
                                                        <th scope="row" class="border-0">
                                                            <input type="hidden" name="product[]"
                                                                value="{{ $cart->product->id }}">
                                                            <div class="p-2">
                                                                <img src="{{ $cart->product->assets->first()->src }}"
                                                                    alt="" width="70"
                                                                    class="img-fluid rounded shadow-sm">
                                                                <div class="ml-3 d-inline-block align-middle">
                                                                    <h5 class="mb-0"> <a href="#"
                                                                            class="text-dark d-inline-block align-middle">{{
                                                                            $cart->product->title }}</a></h5><span
                                                                        class="text-muted font-weight-normal font-italic d-block">Category:
                                                                        {{ $cart->product->category->title }}</span>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <td class="border-0 align-middle"><strong
                                                                data-raw_price="{{ $cart->product->price }}"
                                                                class="price">Rp. {{ number_format
                                                                ($cart->product->price * $cart->quantity,2,",",".")
                                                                }}</strong></td>
                                                        <td class="border-0 align-middle">
                                                            <div
                                                                class="input-group w-auto justify-content-end align-items-center">
                                                                <input type="button" value="-"
                                                                    class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                                    data-field="quantity">
                                                                <input type="number" name="quantity[]" min="1" step="1"
                                                                    max="10" value="{{ $cart->quantity }}"
                                                                    class="quantity-field border-0 text-center w-25">
                                                                <input type="button" value="+"
                                                                    class="button-plus border rounded-circle icon-shape icon-sm "
                                                                    data-field="quantity">
                                                            </div>
                                                        </td>
                                                        <td class="border-0 align-middle"><a href="#"
                                                                class="text-dark"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @empty
                                                    <tr class="text-center text-muted">
                                                        <td colspan="4">Cart Kosong</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- End -->
                                    </div>
                                </div>

                                @if ($addresses->isNotEmpty())
                                    <div class="row p-4 bg-white rounded">
                                        @include('frontend.cart._address', compact('addresses'))
                                    </div>
                                @endif

                                @if($addresses->isEmpty())
                                    <div class="row py-5 p-4 bg-white rounded" id="form-add-address">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi</label>
                                                <select class="form-control" id="provinsi">
                                                    <option selected disabled>==Pilih==</< /option>

                                                        @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</< /option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="kota">Kabupaten/Kota</label>
                                                <select class="form-control" id="kota">
                                                    <option selected disabled>==Pilih==</< /option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <select class="form-control" id="kecamatan">
                                                    <option selected disabled>==Pilih==</< /option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="kelurahan">Desa/Kelurahan</label>
                                                <select class="form-control" id="kelurahan">
                                                    <option selected disabled>==Pilih==</< /option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="detail">Detail Address</label>
                                                <textarea class="form-control" id="detail" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="postal_code">Postal Code</label>
                                                <input type="number" name="postal_code" id="postal_code" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div id="map"></div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" id="add-address" class="btn btn-primary" disabled>Tambah Alamat</button>
                                        </div>
                                    </div>
                                @endif
                                <div class="row py-5 p-4 bg-white rounded">
                                    <div class="col-lg-6">
                                        {{-- <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">
                                            Payment Method</div>
                                        <div class="p-4">
                                            <p class="font-italic mb-4">
                                                If you have a coupon code, please enter it in the box below
                                            </p>
                                            <div class="form-group">
                                                <select class="form-control" name="payMethod" id="payMethod" required>
                                                    <option value="01">Credit Card</option>
                                                    <option value="02">Virtual Account</option>
                                                    <option value="03">Convenience Store</option>
                                                    <option value="04">ClickPay</option>
                                                    <option value="05">E-Wallet</option>
                                                    <option value="08">QRIS</option>
                                                    <option value="08">GPN Card</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">
                                            Coupon code</div>
                                        <div class="p-4">
                                            <p class="font-italic mb-4">
                                                If you have a coupon code, please enter it in the box below
                                            </p>
                                            <div class="input-group mb-4 border rounded-pill p-2">
                                                <input type="text" placeholder="Apply coupon"
                                                    aria-describedby="button-addon3" class="form-control border-0">
                                                <div class="input-group-append border-0">
                                                    <button id="button-addon3" type="button"
                                                        class="btn btn-primary px-4 rounded-pill">
                                                        <i class="fa fa-gift mr-2"></i> Apply coupon
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">
                                            Instructions for seller
                                        </div>
                                        <div class="p-4">
                                            <p class="font-italic mb-4">
                                                If you have some information for the seller you can leave them in the
                                                box below</p>
                                            <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">
                                            Order summary
                                        </div>
                                        <div class="p-4">
                                            <p class="font-italic mb-4">
                                                Shipping and additional costs are calculated based
                                                on values you
                                                have entered.
                                            </p>
                                            <ul class="list-unstyled mb-4">
                                                <li class="d-flex justify-content-between py-3 border-bottom">
                                                    <strong class="text-muted">Order Subtotal</strong>
                                                    <strong id="order_subtotal" data-raw_price="{{$order_subtotal}}">
                                                        Rp. {{ number_format ($order_subtotal,2,",",".") }}
                                                    </strong>
                                                </li>
                                                <li class="d-flex justify-content-between py-3 border-bottom">
                                                    <strong class="text-muted">Shipping and handling</strong>
                                                    <strong id="shipping" data-raw_price="10000">Rp. 10.000,00</strong>
                                                </li>
                                                <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                        class="text-muted">Total</strong>
                                                    <h5 class="font-weight-bold"
                                                        data-raw_price="{{$order_subtotal + 10000}}" id="total">
                                                        Rp. {{ number_format ($order_subtotal + 10000,2,",",".") }}
                                                    </h5>
                                                </li>
                                            </ul>
                                            <button type="submit" class="btn btn-primary rounded-pill py-2 btn-block">
                                                Procceed to checkout
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let url_form;
    const options_temp = '<option value="" selected disabled>==Pilh==<option>';
        

        // $('#payMethod').change(function(e){
        //     if($(this).val() == 01){
        //         url_form = '{{ url("chargeCC") }}'
        //     }else if($(this).val() == 02){
        //         url_form = '{{ url("requestVA") }}'
        //     }else if($(this).val() == 03){
        //         url_form = '{{ url("requestCVS") }}'
        //     }else if($(this).val() == 04){
        //         url_form = '{{ url("requestCPay") }}'
        //     }else if($(this).val() == 05){
        //         url_form = '{{ url("requestEWallet") }}'
        //     }else if($(this).val() == 06){
        //     }else if($(this).val() == 08){

        //     }

        //     $('form#checkout').attr('action', url_form);

        // });



        function incrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input.quantity-field').val(), 10);

            if (!isNaN(currentVal)) {
                parent.find('input.quantity-field').val(currentVal + 1);
            } else {
                parent.find('input.quantity-field').val(0);
            }
            parent.find('input.quantity-field').trigger('change')
            
        }

        function decrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input.quantity-field').val(), 10);

            if (!isNaN(currentVal) && currentVal > 0) {
                parent.find('input.quantity-field').val(currentVal - 1);
            } else {
                parent.find('input.quantity-field').val(0);
            }
            parent.find('input.quantity-field').trigger('change')
        }

        $('.price').change(function(){
            let order_subtotal = 0;
            $('.price').each(function(){
                const quantity = $(this).closest('tr').find('.quantity-field').val();
                const price = $(this).data('raw_price');
                order_subtotal+= parseInt(price) * parseInt(quantity);
            })

            $('#order_subtotal').data('raw_price', order_subtotal)
            $('#order_subtotal').html(formatRupiah(order_subtotal, 'Rp. ', ',00'))
            $('#order_subtotal').trigger('change')
        })

        $('#order_subtotal, #shipping').change(function(){
            const order_subtotal = $('#order_subtotal').data('raw_price');
            const shipping = $('#shipping').data('raw_price');

            $('#total').data('raw_price', order_subtotal + shipping)
            $('#total').html(formatRupiah(order_subtotal + shipping, 'Rp. ', ',00'))
            $('#total').trigger('change')
        })

        $('#total').change(function(){
            $('#amt').val($(this).data('raw_price'))
        })

        $('.input-group').on('click', '.button-plus', function(e) {
            incrementValue(e);
        
        });
        
        $('.input-group').on('click', '.button-minus', function(e) {
            decrementValue(e);
        });

        $('.quantity-field').change(function(){
            const parent = $(this).closest('tr');
            const raw_price = parent.find('.price').data('raw_price');
            parent.find('.price').html(formatRupiah(raw_price * parent.find('.quantity-field').val(), 'Rp. ', ',00'));
            $('.price').trigger('change');
        });


        function getLocation() {
            if (navigator.geolocation) {
                
                navigator.geolocation.getCurrentPosition(initMap, function(error) {
                    alert('Error occurred. Error code: ' + error.code);
                },{timeout:5000});
            } else {
                alert("Geolocation is not supported by this browser.")
            }
        }
        
        function initMap(position) {
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);


            var theMarker = {};

            map.on('click',function(e){
                lat = e.latlng.lat;
                lon = e.latlng.lng;

                console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );
                    //Clear existing marker, 

                    if (theMarker != undefined) {
                        map.removeLayer(theMarker);
                    };

                //Add a marker to show where you clicked.
                theMarker = L.marker([lat,lon]).addTo(map);  
            });
        }


        $(function(){
            // getLocation();
            checkShipping();
            @if($addresses->isEmpty())
                var map = L.map('map').setView([-6.405975, 106.994896], 13);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);


                var theMarker = {};

                map.on('click', function(e){
                    lat = e.latlng.lat;
                    lon = e.latlng.lng;
                    localStorage.setItem('latitude', lat)
                    localStorage.setItem('longitude', lon)
                    $('#add-address').prop('disabled', false);

                    console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );

                        //Clear existing marker, 
                        if (theMarker != undefined) {
                            map.removeLayer(theMarker);
                        };

                    //Add a marker to show where you clicked.
                    theMarker = L.marker([lat,lon]).addTo(map);  
                });
            @endif
        })


        $('#provinsi').change(function() {
            $('#kota, #kecamatan, #kelurahan').html(options_temp);
            if ($(this).val() != "") {
                getKabupatenKota($(this).val());
            }
        })

        $('#kota').change(function() {
            $('#kecamatan, #kelurahan').html(options_temp);
            if ($(this).val() != "") {
                getKecamatan($(this).val());
            }

        })

        $('#kecamatan').change(function() {
            $('#kelurahan').html(options_temp);
            if ($(this).val() != "") {
                getKelurahan($(this).val());
            }
        })

        $('#kelurahan').change(function() {
            if ($(this).val() != "") {
                $('#zip_code').val($(this).find(':selected').data('pos'))
            } else {
                $('#zip_code').val('')
            }
        });

        function getKabupatenKota(provinsiId) {
            let url = '{{ route('api.regencies', ':id') }}';
            url = url.replace(':id', provinsiId)
            $.ajax({
                url,
                method: 'GET',
                beforeSend: function() {
                    $('#kota').prop('disabled', true);
                },
                success: function(res) {
                    const options = res.map(value => {
                        return `<option value="${value.id}">${value.name}</option>`
                    });
                    $('#kota').html(options_temp + options)
                    $('#kota').prop('disabled', false);
                },
                error: function(err) {
                    $('#kota').prop('disabled', false);
                    alert(JSON.stringify(err))
                }

            })
        }

        function getKecamatan(kotaId) {
            let url = '{{ route('api.districts', ':id') }}';
            url = url.replace(':id', kotaId)
            $.ajax({
                url,
                method: 'GET',
                beforeSend: function() {
                    $('#kecamatan').prop('disabled', true);
                },
                success: function(res) {
                    const options = res.map(value => {
                        return `<option value="${value.id}">${value.name}</option>`
                    });
                    $('#kecamatan').html(options_temp + options);
                    $('#kecamatan').prop('disabled', false);
                },
                error: function(err) {
                    alert(JSON.stringify(err))
                    $('#kecamatan').prop('disabled', false);
                }
            })
        }

        function getKelurahan(kotaId) {
            let url = '{{ route('api.villages', ':id') }}';
            url = url.replace(':id', kotaId)
            $.ajax({
                url,
                method: 'GET',
                beforeSend: function() {
                    $('#kelurahan').prop('disabled', true);
                },
                success: function(res) {
                    const options = res.map(value => {
                        return `<option value="${value.id}" >${value.name}</option>`
                    });
                    $('#kelurahan').html(options_temp + options);
                    $('#kelurahan').prop('disabled', false);
                },
                error: function(err) {
                    alert(JSON.stringify(err))
                    $('#kelurahan').prop('disabled', false);
                }
            })
        }

        $('#add-address').click(function(){

            const data = {
                province_id : $('#provinsi').val(),
                regency_id  : $('#kota').val(),
                district_id : $('#kecamatan').val(),
                village_id  : $('#kelurahan').val(),
                detail      : $('#detail').val(),
                postal_code : $('#postal_code').val(),
                latitude    : localStorage.getItem('latitude'),
                longitude   : localStorage.getItem('longitude'),
            };

            $.ajax({
                url: '{{ route("fe.addresses.store") }}',
                method: 'POST',
                data,
                success: function(res){
                    console.log(res);
                    $('#form-add-address').html(res);
                },
                error: function(err){
                    console.log(err)
                }
            })
        })

        function checkShipping(){
            const data = {}
            
            $('.address_id').each(function(){
                if($(this).is(':checked')){
                    data.latitude       = $(this).data('latitude')
                    data.longitude      = $(this).data('longitude')
                    data.postal_code    = $(this).data('postal_code')
                }
            })


            $.ajax({
                url: '{{ route("fe.shipping.check") }}',
                method: 'get',
                data,
                success: function(res){
                    console.log(res);
                },
                error: function(err){
                    console.log(err);
                }
            })
        }
        
</script>
@endpush