{{-- <div class="col-12 mb-3">
    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">
        Address Shipping
    </div>
</div> --}}
@foreach ($addresses as $address)
<div class="col-12 p-3">
    <div class="form-check">
        <input class="form-check-input address_id" type="radio" name="address_id" id="exampleRadios1"
            value="{{ $address->id }}" data-latitude="{{ $address->latitude }}"
            data-longitude="{{ $address->longitude }}" data-postal_code="{{ $address->postal_code }}" {{
            $address->is_priority > 0 ? 'checked' : '' }}
        >
        <label class="form-check-label" for="exampleRadios1">
            <div>{{ $address->province->name }}</div>
            <small class="text-muted">{{ $address->detail }}</small>
        </label>
    </div>
</div>
@endforeach