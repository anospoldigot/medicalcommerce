@extends('layouts.frontend', [
'disableHero' => 1,
'disableFooter' => 1
])

@push('styles')
<style>
    .timeline {
        /* Used to position the left vertical line */
        position: relative;
    }

    .timeline__line {
        /* Border */
        border-right: 2px solid #a6b9d6;

        /* Positioned at the left */
        left: 0.75rem;
        position: absolute;
        top: 0px;

        /* Take full height */
        height: 100%;
    }

    .timeline__items {
        /* Reset styles */
        list-style-type: none;
        margin: 0px;
        padding: 0px;
    }

    .timeline__item {
        margin-bottom: 20px;
    }

    .timeline__top {
        /* Center the content horizontally */
        align-items: center;
        display: flex;
    }

    .timeline__circle {
        /* Rounded border */
        background-color: #a6b9d6;
        border-radius: 9999px;

        /* Size */
        height: 1.5rem;
        width: 1.5rem;
    }

    .timeline__title {
        /* Take available width */
        flex: 1;
        margin-left: 0.5rem;
    }

    .timeline__desc {
        /* Make it align with the title */
        margin-left: 2rem;
    }
</style>
@endpush

@section('content')
<form action="{{ route("fe.orders.finish", $order->id) }}" method="post" id="finishOrder">
    @csrf
    @method('PATCH')
</form>
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('fe.orders.rating.store', $order->id) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Beri Rating</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($order->items as $key => $item)
                    <div class="form-group">
                        <label for="">{{ $key+1 . ' ' . $item->name }}</label>
                        <select class="rating" id="example">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <textarea name="" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="px-1 mb-3">
                <h2>Invoice</h2>
                <h6>#{{ $order->transaction->invoice_number }}</h6>
            </div>
            <div class="bg-white p-4" style="border-radius: 10px;">
                <div class="mb-3">
                    <button onclick="finishOrder('{{ $order->id }}')" class="btn btn-outline-primary" {{ $order->status
                        == 'COMPLETE' ? 'disabled' : '' }}>
                        <i class="fa-solid fa-box mr-1"></i>Pesanan Diterima
                    </button>
                    <button data-toggle="modal" data-target="#ratingModal" class="btn btn-outline-success"><i
                            class="fa-solid fa-star mr-1"></i>Beri Ulasan</button>
                        <button class="btn btn-outline-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            Invoice
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('fe.orders.invoice.pdf', $order->id) }}" >PDF</a>
                            <a class="dropdown-item" href="#">Excel</a>
                        </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-12 col-lg-5">
                        <div class="font-weight-bold text-secondary mb-3">To:</div>
                        <div>{{ ucwords(strtolower($order->shipping_address)) }}</div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-between mb-2">
                            <div>Date Issue :</div>
                            <div>{{ \Carbon\Carbon::create($order->created_at)->format('d/m/Y') }}</div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <div>Due Date :</div>
                            <div>{{ \Carbon\Carbon::create($order->created_at)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
                <div class="row justify-content-between mb-5">
                    <div class="col-12 col-lg-6">
                        <div>
                            <div class="font-weight-bold text-secondary mb-3">Payment Details:</div>
                            <div class="row mb-1">
                                <div class="col-4">Total</div>
                                <div class="col-8">: Rp. {{ number_format ($order->transaction->amount,2,",",".") }}
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-4">Payment Name</div>
                                <div class="col-8">: {{ $order->transaction->payment_name }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-4">Payment Code</div>
                                <div class="col-8">: {{ $order->transaction->payment_code }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-4">Status</div>
                                <div class="col-8">: <span class="badge alert-{{$order->order_status_color}}">{{
                                        $order->status_label }}</span></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        @if ($response)
                            <div class="timeline">
                                <!-- Left vertical line -->
                                <div class="timeline__line"></div>

                                <!-- The timeline items timeline -->
                                <div class="timeline__items">
                                    <!-- Each timeline item -->
                                    @foreach (collect($response->history)->reverse() as $timeline)
                                    <div class="timeline__item">
                                        <!-- The circle and title -->
                                        <div class="timeline__top">
                                            <!-- The circle -->
                                            <div class="timeline__circle"></div>

                                            <!-- The title -->
                                            <div class="timeline__title font-weight-bold">{{ strtoupper(str_replace("_", "",
                                                $timeline->status)) }}</div>
                                        </div>

                                        <!-- The description -->
                                        <div class="timeline__desc">
                                            <small class="text-muted">{{ $timeline->note }}</small>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <hr class="my-5">
                <div>
                    <div class="font-weight-bold text-secondary mb-3">Item Details:</div>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    @if (empty($item->review))
                                    <button data-toggle="modal" data-target="#ratingModal{{$item->id}}"
                                        class="btn btn-outline-success">
                                        <i class="fa-solid fa-star mr-1"></i>Beri Ulasan
                                    </button>
                                    @else
                                    <button data-toggle="modal" data-target="#ratingModal{{$item->id}}"
                                        class="btn btn-outline-success">
                                        <i class="fa-solid fa-star mr-1"></i>Lihat Ulasan
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @if (empty($item->review))
                            <div class="modal fade" id="ratingModal{{$item->id}}" tabindex="-1"
                                aria-labelledby="ratingModal{{$item->id}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('fe.orders.rating.store', $order->id) }}" method="post"
                                        class="rating-form">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ratingModal{{$item->id}}Label">Beri Rating
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                <input type="hidden" name="rating" value="1" class="rating-input">
                                                <div class="form-group">
                                                    <label for="">{{ $key+1 . ' ' . $item->name }}</label>
                                                    <select class="rating" name="rating">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="comment" class="form-control" id="" cols="30"
                                                        rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary submit-btn">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                            <div class="modal fade" id="ratingModal{{$item->id}}" tabindex="-1" aria-labelledby="ratingModal{{$item->id}}Label"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('fe.orders.rating.store', $order->id) }}" method="post" class="rating-form">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ratingModal{{$item->id}}Label">Beri Rating
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                <input type="hidden" name="rating" value="1" class="rating-input">
                                                <div class="form-group">
                                                    <label for="">{{ $key+1 . ' ' . $item->name }}</label>
                                                    <select class="rating" name="rating">
                                                        <option value="1" @selected($item->review->rating == 1)>1</option>
                                                        <option value="2" @selected($item->review->rating == 2)>2</option>
                                                        <option value="3" @selected($item->review->rating == 3)>3</option>
                                                        <option value="4" @selected($item->review->rating == 4)>4</option>
                                                        <option value="5" @selected($item->review->rating == 5)>5</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="comment" class="form-control" id="" cols="30" rows="3" disabled>{{  $item->review->comment}}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary submit-btn">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function finishOrder (orderId)
        {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: "Ketika anda telah mengonfirmasi pesanan anda tidak dapat mengembalikan pesanan tersebut",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Konfirmasi '
                }).then((result) => {

                    if (result.isConfirmed) {
                        $('form#finishOrder').submit()
                    }
            })
        } 

        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {
                    console.log($(event.target).closest('.modal-body').find('.rating-input').val(value));
                }
            });

            
        });


        $('form.rating-form').submit(function(){
            event.preventDefault()
            
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
                    }else{
                        PNotify.error({
                            title: 'Error!',
                            text: res.message
                        });
                    }

                    setTimeout(() => {
                        location.reload()
                    }, 1500);
                    
                },
                error: function(err){
                    PNotify.error({
                        title: 'Error!',
                        text: err.responseJSON.message
                    });
                }
            })

        })
</script>
@endpush