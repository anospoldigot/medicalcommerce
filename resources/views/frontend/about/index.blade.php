@extends('layouts.frontend', [
'disableHero' => 1,
])

@push('styles')
<style>
    .icon-style{
        font-size: 50px;
    }
    
    .text-icon-style {
        vertical-align: center
    }
    
    .hero-container-contact{
        background: url({{ asset('frontend/img/headerdoctor.jpg') }});
        background-size: cover;
        background-position: center center;
    }
    
    .hero-contact{
        background-color: rgba(255, 255, 255, 0.8);
        height: 400px;
    }
</style>
@endpush

@section('content')

<div class="hero-container-contact mb-5">
    <div class="hero-contact">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="text-center text-uppercase">
                <h6>About <span class="text-primary">Us</span></h6>
                <h1>PT <span class="text-primary">Pertama</span> mitra medika</h1>
            </div>
        </div>
    </div>
</div>

<section id="about" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">About</h2>
        <div class="row py-5">
            <div class="col-6 d-flex align-items-center  flex-wrap">
                {{-- <img src="{{ asset('frontend/img/logo.png') }}" alt="" width="200">
                <div class="col mb-4">
                    <h5>PT. Pertama Mitra Medika</h5>
                </div> --}}
                <div class="col-12">
                    <small>PT. Artha Medika Sentosa Didirikan
                        pada tahun 2015 yang bergerak pada
                        bidang distribusi alat – alat kesehatan
                        dengan kualitas dan pelayanan terbaik.
                        Perusahaan ini berkedudukan
                        di gedung Artha, Ruko Rose Garden
                        RRG 5 Nomor 115 Galaxy Bekasi
                        Selatan, Kel.Jakasetia, Kec. Bekasi
                        Selatan, Kota Bekasi, Prov. Jawa Barat</small>
                </div>
            </div>
            <div class="col-6">
                <div class="p-4">
                    <h5 class="text-uppercase mb-4">Perjalanan Pertama mitra medika</h5>
                    <div class="row">
                        <div class="col">
                            <div><h3 class="font-weight-bold">1000</h3></div>
                            Active Users
                        </div>
                        <div class="col">
                            <div>
                                <h3 class="font-weight-bold">8</h3>
                            </div>
                            Partner
                        </div>
                        <div class="col">
                            <div>
                                <h3 class="font-weight-bold">8+</h3>
                            </div>
                            Tahun
                        </div>
                    </div>
                </div>
                {{-- <div class="mb-4" id="visi">
                    <h4 class="text-center mb-3">Visi</h4>
                    <div>
                        <small>Menjadi perusahaan distributor alat-alat kesehatan yang menjual dengan kualitas terbaik. dengan
                            harga
                            kompetitif
                            dan
                            memberikan pelayanan terbaik serta mensejahterakan karyawan.</small>
                    </div>
                </div>
                <div class="mb-4" id="misi">
                    <h4 class="text-center mb-3">Misi</h4>
                    <div>
                        <small>Berorientasi pada pemenuhan kebutuhan Rumah Sakit/ Dinas Kesehatan dalam pelayanan masyarakat
                            dibidang penyedian
                            alat-alat kesehatan. Mengelola dan mengembangkan SDM sebagai modal awal untuk mendukung
                            terlaksananya
                            VISI
                            perusahaan
                            Menjalankan usaha secara adil dengan memperhatikan azas manfaat bagi semua pihak yang terlibat.
                            Membangun
                            koordinasi dan
                            kemitraan yang erat dengan seluruh karyawan dan mitra usaha grup perusahaan untuk Bersama mencapai
                            sukses dan
                            memberikan
                            pelayanan yang berkualitas</small>
                    </div>
                </div> --}}
            </div>
            <div class="col-6">
                
            </div>
        </div>
    </div>

</section>
<section id="visi-misi" class="py-5 bg-white">
    <div class="container">
            
            <h2 class="text-center mb-5">Klien Kami</h2>
            <div class="glide" id="klien">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides d-flex">
                        @foreach ($paymentMethodList->paymentFee as $payment)
                            <li class="glide__slide align-items-center">
                                <img src="{{ $payment->paymentImage }}" width="125">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    var map = L.map('map').setView([-6.405975, 106.994896], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            }).addTo(map);
    
            var marker = L.marker([-6.405975, 106.994896]).addTo(map);
    
            $('form#contact').submit(function(){
    
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res){
                        if(res.success){
                            PNotify.success({
                                title: 'Success!',
                                text: res.message
                            });
    
                            $('form#contact')[0].reset()
                        }
                    },
                    error: function(err){
    
                    }
                })
    
    
                return false;
            })

        const klien = new Glide('#klien', {
            autoplay: 3000,
            rewind: true,
            perView: 6,
            gap: 25
        }).mount()
</script>
@endpush