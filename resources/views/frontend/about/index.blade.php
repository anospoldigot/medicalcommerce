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
        <div class="row mb-5">
            <div class="col-6 d-flex align-items-center">
                <img src="{{ asset('frontend/img/logo.png') }}" alt="" width="200">
                <div class="col">
                    <h5>PT. Pertama Mitra Medika</h5>
                </div>
            </div>
            <div class="col-6">
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
    </div>

</section>
<section id="visi-misi" class="py-5 bg-white">
    <div class="container">

        <div class="mb-4" id="visi">
            <h2 class="text-center mb-3">Visi</h2>
            <div>
                <small>Menjadi perusahaan distributor alat-alat kesehatan yang menjual dengan kualitas terbaik. dengan
                    harga
                    kompetitif
                    dan
                    memberikan pelayanan terbaik serta mensejahterakan karyawan.</small>
            </div>
        </div>
        <div class="mb-4" id="misi">
            <h2 class="text-center mb-3">Misi</h2>
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
        </div>
    </div>
</section>
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-6">
            @foreach ($contact as $c)
            <div class="d-flex mb-5">
                <div class="px-2 icon-style text-primary"><i class="{{$c->first()->icon_class}}"></i></div>
                <div class="px-2 flex-grow text-icon-style d-flex align-items-center">
                    @foreach ($c as $v)
                        {{ $v->value }} <br />
                    @endforeach
                </div>
            </div>
            @endforeach
            {{-- <div class="d-flex mb-5">
                <div class="px-2 icon-style text-primary"><i class="fa-solid fa-phone"></i></div>
                <div class="px-2 flex-grow text-icon-style">Jl. Kesehatan Raya No. 20, Bintaro, Jakarta Selatan</div>
            </div>
            <div class="d-flex mb-5">
                <div class="px-2 icon-style text-primary"><i class="fa-solid fa-envelope"></i></div>
                <div class="px-2 flex-grow text-icon-style">Jl. Kesehatan Raya No. 20, Bintaro, Jakarta Selatan</div>
            </div> --}}
        </div>
        <div class="col-6">
            <h3 class="mb-4">Contact Form</h3>
            <form action="{{ route('fe.contact.store') }}" method="post" id="contact">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Name" name="name" id="name">
                    </div>
                    <div class="col">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Subject" name="subject" id="subject">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <textarea type="text" class="form-control" placeholder="Message" name="message"
                            id="message"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary text-right">Submit</button>
            </form>
        </div>
    </div>
    <div id="map"></div>
</div>
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
</script>
@endpush