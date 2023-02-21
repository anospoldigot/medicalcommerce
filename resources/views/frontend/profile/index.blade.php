@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1
])

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="bg-white p-3" style="border-radius: 12px;">
                <div class="col-8">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush