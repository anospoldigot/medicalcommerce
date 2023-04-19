@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Transaction
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
<div class="mb-1">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
        <i data-feather='plus'></i> Create
    </button>
    <a href="{{ route('transactions.report') }}" class="btn btn-danger">Report</a>
</div>
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route("transactions.store") }}" method="post" class="create">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" oninput="currencyInput()">
                    </div>
                    <div class="form-group">
                        <label for="note">Jenis Transaksi</label>
                        <select name="type" id="type" class="form-control">
                            <option value="" selected>==Pilih==</option>
                            <option value="in">Pemasukan (in) </option>
                            <option value="out">Pengeluaran (out)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="note">Description / Note</label>
                        <textarea name="note" id="note" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i data-feather='save'
                            class="mr-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h6>Filter</h6>
        {{-- <a class="btn btn-sm btn-primary mb-1 float-right" href="{{ route('coupons.create') }}">
            <i data-feather='plus'></i> Create
        </a> --}}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label for="date_range">Date Range:</label>
                    <input type="text" name="date_range" id="date_range" class="form-control">
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label for="">Min Amount</label>
                    <input type="text" name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount" oninput="currencyInput()">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Max Amount</label>
                    <input type="text" name="max_amount" id="max_amount" class="form-control" placeholder="Min Amount"
                        oninput="currencyInput()">
                </div>
            </div>
            <div class="col-12 text-right">
                <button class="btn btn-outline-primary" id="reset-filter"><i data-feather='refresh-cw'
                        class="mr-1"></i>Clear</button>
                <button class="btn btn-primary" id="filter"><i data-feather='filter' class="mr-1"></i>Filter</button>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <table class="datatables-basic table">
        <thead>
            <tr>
                <th>#</th>
                <th>Note</th>
                <th>Tipe</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){

        var picker = flatpickr('#date_range', {
            mode: 'range',
            dateFormat: 'Y-m-d',
            onClose: function(selectedDates, dateStr, instance) {
                table.draw();
            }
        });


        $('form.create').submit(function(){
            event.preventDefault();
            const data = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data,
                dataType: 'json',
                success: function(res){
                    if(res.success){
                        toastr['success'](res.message, 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                        $('#createModal').modal('hide');
                        table.ajax.reload();
                    }else{
                        toastr['error'](res.message, 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                    }
                },
                error: function(err){
                    toastr['error'](err.responseJSON.message, 'Error!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                }
            })
        })

        $(document).on('submit', 'form.delete', function(){
            event.preventDefault();
            const data = $(this).serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(this);
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data,
                        dataType: 'json',
                        success: function(res){
                            if(res.success){
                                toastr['success'](res.message, 'Success!', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });
                                table.ajax.reload();
                            }else{
                                toastr['error'](res.message, 'Error!', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                    rtl: isRtl
                                });
                            }
                        },
                        error: function(err){
                            toastr['error'](err.responseJSON.message, 'Error!', {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: isRtl
                            });
                        }
                    })
                }
            })
        })

        const table =
            $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("transactions.index") }}',
                    data: function (d) {
                        const params = new URLSearchParams(window.location.search);
                        const type = params.get('type');
                        if(type) d.type = type;
                        d.start_date = picker.selectedDates[0] ? picker.formatDate(picker.selectedDates[0], 'Y-m-d') : '';
                        d.end_date = picker.selectedDates[1] ? picker.formatDate(picker.selectedDates[1], 'Y-m-d') : '';
                        d.min_amount = $('#min_amount').val();
                        d.max_amount = $('#max_amount').val();
                    }
                },
                columns: [
                    { 
                        data: 'id',
                        name: 'id'
                    },
                    { 
                        data: 'note',
                        name: 'note'
                    },
                    { 
                        data: 'type',
                        render: function(data){
                            let color = 'danger';

                            if(data == 'in'){
                                color = 'success';
                            }

                            return `<span class="badge badge-${color}">${data}</span>`
                        }
                    },
                    { 
                        data: 'amount',
                        render: function(data){
                            return formatRupiah(data, 'Rp. ', '.00')
                        }
                    },
                    { 
                        data: 'created_at',
                        render: function(data){
                            return moment(data).format('MMMM Do YYYY')
                        }
                    },
                    { 
                        data: 'action',
                        name: 'action'
                    },
                    
                ],
                dom: `<"card-header border-bottom p-1"<"head-label">
                    <"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12
                            col-md-6"l>
                            <"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i>
                                    <"col-sm-12 col-md-6"p>>`,
                drawCallback: function( settings ) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                },
                rowCallback: function(row, data, index) {
                    $('td:eq(0)', row).html(index + 1);
                }
            });
            $('div.head-label').html('<h6 class="mb-0">Data Transaksi</h6>');

            // Set event to filter data when date range is changed
            picker.element.addEventListener('change', function(e) {
                table.draw();
            });

            // Set event to clear date range filter
            $('#date_range_clear').click(function() {
                picker.clear();
                table.draw();
            });

            $('#reset-filter').click(function () {
                picker.clear();
                $('#min_amount').val('');
                $('#max_amount').val('');
                table.draw();
            })

            $('#filter').click(function () {
                table.draw();
            })
    })
</script>
@endpush