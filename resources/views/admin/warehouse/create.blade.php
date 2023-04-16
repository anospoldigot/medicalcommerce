@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Warehouse</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Warehouse</a>
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
        <h4 class="card-title">Create Warehouse</h4>
    </div>
    <div class="card-body">
        @if (!empty($errors))
            {{ $errors->first() }}
        @endif
        <form action="{{ route('warehouses.store') }}" method="post" enctype="multipart/form-data"
            id="create-warehouse">
            @csrf
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feeback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="4"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feeback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6 ">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select class="form-control" id="provinsi" name="province_id">
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
                                <select class="form-control" id="kota" name="regency_id">
                                    <option selected disabled>==Pilih==</< /option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="district_id">
                                    <option selected disabled>==Pilih==</< /option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="kelurahan">Desa/Kelurahan</label>
                                <select class="form-control" id="kelurahan" name="village_id">
                                    <option selected disabled>==Pilih==</< /option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="number" name="postal_code" id="postal_code" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <div id="map"></div>
                </div>
                <div class="col-12">
                    @error('latitude')
                        <div><small class="text-danger">{{ $message }}</small></div>
                    @enderror
                    @error('longitude')
                        <div><small class="text-danger">{{ $message }}</small></div>
                    @enderror
                </div>
            </div>
            <div class="text-right">
                <a href="{{ route('warehouses.index') }}" class="btn btn-outline-primary"><i
                        data-feather='corner-up-left'></i> Batal</a>
               
                <button type="submit" class="btn btn-primary"><i data-feather='save'></i> Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const options_temp = '<option value="" selected disabled>==Pilih==</option>';

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

        var map = L.map('map').setView([-6.405975, 106.994896], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        var theMarker = {};

        map.on('click', function(e){
            lat = e.latlng.lat;
            lon = e.latlng.lng;
            $('#latitude').val(lat)
            $('#longitude').val(lon)

            
            console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );

                //Clear existing marker, 
                if (theMarker != undefined) {
                    map.removeLayer(theMarker);
                };

            //Add a marker to show where you clicked.
            theMarker = L.marker([lat,lon]).addTo(map);  
        });



</script>
@endpush