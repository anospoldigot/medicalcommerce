@extends('layouts.frontend', [
'disableHero' => 1
])

@section('content')

<div style="background: #7158e226">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="text-center">
                            <h6 class="text-center">No. Virtual Account</h6>
                            <h2 style="letter-spacing: 2px;">{{ json_decode($transaksi->raw_callback)->bankVacctNo }}</h2>
                            <div>Status: <span class="badge badge-warning">Waiting</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush