@extends('layouts.frontend', [
'disableHero' => 1,
])

@push('styles')
<style>
    .icon-style {
        font-size: 50px;
    }

    .text-icon-style {
        vertical-align: center
    }

    .hero-container-contact {
        background: url("{{ asset('frontend/img/headerdoctor.jpg')}}");
    background-size: cover;
    background-position: center center;
    }

    .hero-contact {
        background-color: rgba(255, 255, 255, 0.8);
        height: 400px;
    }

    .quote-container {
        position: relative;
        background-color: #ffffff;
        color: #000000;
        border-radius: 10px;
        max-width: 350px;
        margin: 0 auto;
        overflow: hidden;
        padding: 20px;
    }

    /* .bottom {
        position: absolute;
        min-height: 200px;
        bottom: 0;
        left: 0;
        line-height: 0;
        transform: rotate(180deg);
        width: 440px;
    }

    .bottom svg.curves {
        position: relative;
        display: block;
        width: 100%;
        height: 300px;
        transform: rotateY(180deg);
    } */

    .bottom .shape-fill {
        fill: #00b7ff;
    }

    .star-rating {
        color: #ff1133;
        margin: 17px 0 10px;
        font-size: 1.8em;
        text-align: center;
    }

    p.quote {
        margin: 15px 0;
        font-size: 14px;
        line-height: 1.3em;
        text-align: center;
    }

    .reviewer-photo {
        position: relative;
        z-index: 9;
        margin: 20px auto 10px;
        text-align: center;
    }

    .reviewer-photo img {
        border-radius: 50%;
        border: 6px solid #ffffff;
        filter: drop-shadow(0px 3px 3px rgba(0, 0, 0, 0.1));
    }

    .reviewer-details {
        position: relative;
        z-index: 9;
        text-align: center;
        /* color: #ffffff; */
    }

    .reviewer-details .name {
        font-size: 20px;
        font-weight: 600;
        display: block;
        padding: 7px 0 10px 0;
    }

    .reviewer-details .title {
        font-size: 17px;
        font-weight: 400;
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
        <div class="row py-5">
            <div class="col-4 d-flex align-items-center  flex-wrap">
                <img src="{{ asset('frontend/img/office.jpg') }}" alt="" class="img-fluid">
            </div>
            <div class="col-8">
                <div class="p-4">
                    <h5 class="text-uppercase mb-4">Perjalanan Pertama mitra medika</h5>
                    <div class="row">
                        <div class="col-12 mb-5"><small>PT. Artha Medika Sentosa Didirikan
                                pada tahun 2015 yang bergerak pada
                                bidang distribusi alat – alat kesehatan
                                dengan kualitas dan pelayanan terbaik.
                                Perusahaan ini berkedudukan
                                di gedung Artha, Ruko Rose Garden
                                RRG 5 Nomor 115 Galaxy Bekasi
                                Selatan, Kel.Jakasetia, Kec. Bekasi
                                Selatan, Kota Bekasi, Prov. Jawa Barat</small></div>
                        <div class="col">
                            <div>
                                <h3 class="font-weight-bold">1000</h3>
                            </div>
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

            </div>
        </div>
    </div>
</section>
<section id="visi-misi" class="py-5 bg-white">
    <div class="container">
        <h2 class="mb-5 text-center">PERTAMA MITRA MEDIKA</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-4" id="visi">
                    <h4 class=" mb-3">Visi</h4>
                    <div>
                        <small>Menjadi perusahaan distributor alat-alat kesehatan yang menjual dengan kualitas terbaik.
                            dengan
                            harga
                            kompetitif
                            dan
                            memberikan pelayanan terbaik serta mensejahterakan karyawan.</small>
                    </div>
                </div>
                <div class="mb-4" id="misi">
                    <h4 class=" mb-3">Misi</h4>
                    <div>
                        <small>Berorientasi pada pemenuhan kebutuhan Rumah Sakit/ Dinas Kesehatan dalam pelayanan
                            masyarakat
                            dibidang penyedian
                            alat-alat kesehatan. Mengelola dan mengembangkan SDM sebagai modal awal untuk mendukung
                            terlaksananya
                            VISI
                            perusahaan
                            Menjalankan usaha secara adil dengan memperhatikan azas manfaat bagi semua pihak yang
                            terlibat.
                            Membangun
                            koordinasi dan
                            kemitraan yang erat dengan seluruh karyawan dan mitra usaha grup perusahaan untuk Bersama
                            mencapai
                            sukses dan
                            memberikan
                            pelayanan yang berkualitas</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h4 class=" mb-3">Layanan</h4>
                <small>
                    Produk yang kami tawarkan meliputi berbagai macam alat medis seperti monitor jantung, nebulizer,
                    hingga alat bantu
                    pernapasan. Kami memiliki tim profesional yang siap membantu pelanggan kami dalam memilih produk
                    yang sesuai dengan
                    kebutuhan mereka. Kami juga menjamin kualitas produk kami, sehingga pelanggan kami dapat merasa aman
                    dalam menggunakan
                    produk kami.

                    Pelanggan kami adalah prioritas kami. Kami selalu berusaha untuk memberikan pelayanan terbaik dan
                    memberikan solusi
                    terbaik bagi pelanggan kami.
                </small>
            </div>
        </div>

    </div>
</section>

<section class="py-5">
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
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Apa kata mereka</h2>
        <div class="glide" id="review">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides d-flex">
                    <li class="glide__slide align-items-center">
                        <div class="quote-container">
                        
                            <div class="star-rating">★★★★★</div>
                        
                            <p class="quote">Kualitas terbaik gak ragu lagi untuk beli kebutuhan rumah sakit atau jadi reseller online</p>
                        
                            <div class="reviewer-photo">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=140&h=140&q=80"
                                    width="140" height="140" alt="Photo of reviewer">
                            </div>
                        
                            <div class="reviewer-details">
                                <span class="name">Sally S.</span>
                            </div>
                        
                            {{-- <div class="bottom">
                                <svg width="100%" height="80">
                                    <rect width="100%" height="80" class="shape-fill" />
                                </svg>
                                <svg class="curves" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900 200"
                                    preserveAspectRatio="none">
                                    <path
                                        d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                                        opacity=".35" class="shape-fill"></path>
                                    <path
                                        d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                                        class="shape-fill"></path>
                                </svg>
                            </div> --}}
                        
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    const klien = new Glide('#klien', {
            autoplay: 3000,
            rewind: true,
            perView: 6,
            gap: 25
        }).mount()

    const review = new Glide('#review', {
            autoplay: 3000,
            rewind: true,
            perView: 3,
            gap: 100
        }).mount()
</script>
@endpush