@extends('layouts.frontend', [
    'disableHero'       => 1,
    'disableFooter'     => 1
])


@section('content')
    <div class="bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-6">
                    @if (session()->has('message'))
                        <div class="alert alert-primary">{{ session('message') }}</div>
                    @endif
                    <div class="bg-white p-5" style="border-radius: 10px">
                        <div class="d-flex justify-content-center">
                            <div id="send-email-animation" style="width: 100px; height: 100px;"></div>
                        </div>
                        <h3 class="text-center">Email verifikasi berhasil dikirim</h3>
                            <p class="text-center">
                                Silahkan cek email anda <span id="countdown"></span>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('verification.send') }}" method="post" id="resend-verify">@csrf</form>
@endsection

@push('scripts')
    
    <script>
        var animation = bodymovin.loadAnimation({
            container: document.getElementById("send-email-animation"),
            renderer: "svg",
            loop: true,
            autoplay: true,
            path: "https://assets3.lottiefiles.com/packages/lf20_nxkmi9um.json"
        });

        // Fungsi yang akan dieksekusi ketika countdown selesai
        
        // Mulai menampilkan countdown
        displayCountdown();

        function resendVerification(){
            $('form#resend-verify').submit();
        }
    </script>
@endpush