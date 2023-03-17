<div class="payment-type">
    <div class="card">
        <div class="card-header flex-column align-items-start">
            <h4 class="card-title">Payment options</h4>
            <p class="card-text text-muted mt-25">Be sure to click on correct payment
                option
            </p>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($paymentMethodList->paymentFee as $payment)
                <div class="col-6 mb-4">
                    <div class="form-check">
                        <input class="form-check-input payment-option mr-1" type="radio" name="paymentMethod"
                            id="paymentMethod{{$payment->paymentMethod}}" value="{{$payment->paymentMethod}}" required
                            data-payment_name="{{$payment->paymentName}}" data-fee="{{ $payment->totalFee }}"/>
                        <label class="form-check-label" for="paymentMethod{{$payment->paymentMethod}}">
                            <img src="{{ $payment->paymentImage }}" width="75" alt="" />
                            <span>{{$payment->paymentName}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <div>Admin : Rp. {{ number_format ($payment->totalFee,2,",",".")  }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>