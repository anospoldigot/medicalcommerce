@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">User</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a>
            </li>
            <li class="breadcrumb-item active">Show
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail User</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row mb-1">
                        <div class="col-6 col-lg-4">
                            <b>Nama</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $user->name }}
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 col-lg-4">
                            <b>Email</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $user->email }}
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 col-lg-4">
                            <b>Phone</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $user->phone ?? '-' }}
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 col-lg-4">
                            <b>Permedik Cash</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {!! $user->is_credit_ative > 0 ? $user->credit : '<span class="badge badge-danger">Nonaktif</span>' !!}
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 col-lg-4">
                            <b>Transaction</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $user->orders->count() ?? '-' }} @if($user->orders->isNotEmpty())  <a href="javascript:void(0)">Click Detail</a>  @endif
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 col-lg-4">
                            <b>Transaction Amount</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : Rp. {{ $user->orders->sum(function ($order) {
                                return $order->transation->amount;
                            })}} 
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6 col-lg-4">
                            <b>Address</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : <a href="javascript:void(0)" data-toggle="modal" data-target="#addressModal">Click Detail</a>
                        </div>
                    </div>
                    {{-- <div class="row mb-1">
                        <div class="col-6 col-lg-4">
                            <b>Role</b>
                        </div>
                        <div class="col-6 col-lg-8">
                            : {{ $user->roles->first()->name }}
                        </div>
                    </div> --}}
                </div>
                <div class="col-12 col-lg-6">
                    <h6><b>Profile User</b></h6>
                    <img src="{{ asset('upload/images/' . $user->profile) }}" alt="profile-user"
                        onerror="this.onerror=null;this.src='{{ $user->profile }}';">
                </div>
            </div>
            <div class="text-right">
                <a href="{{ route('users.index') }}" class="btn btn-outline-primary"><i data-feather='corner-up-left'></i>
                    Back</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Address {{ $user->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="text-lowercase">
                        @forelse ($user->addresses as $address)
                            <li class="mb-1">
                                {{ $address->province->name }}, {{ $address->regency->name }}, {{ $address->district->name }}, 
                                {{ $address->village->name }}, {{ "($address->detail)" }} @if($address->is_priority > 0) <span class="badge badge-success">Alamat Utama</span> @endif
                            </li>
                        @empty 
                            <div class="text-center">Alamat Kosong</div>
                        @endforelse
                    </ul>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection