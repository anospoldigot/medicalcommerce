@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Home</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Order
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')


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
                    <label for="date_range">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected>==Pilih==</option>
                        <option value="COMPLETE" >Complete</option>
                        <option value="SHIPPING" >Shipping</option>
                        <option value="PROCESS" >Process</option>
                        <option value="ISSUED" >Paid</option>
                        <option value="batal" >Cancel</option>
                    </select>
                </div>
            </div>
            <div class="col-12 text-right">
                <button class="btn btn-outline-primary" id="reset-filter"><i data-feather='refresh-cw' class="mr-1"></i>Clear</button>
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
                <th>Invoice Number</th>
                <th>Status</th>
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

        const table = 
         $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("orders.index") }}',
                    data: d => {
                        d.start_date = picker.selectedDates[0] ? picker.formatDate(picker.selectedDates[0], 'Y-m-d') : '';
                        d.end_date = picker.selectedDates[1] ? picker.formatDate(picker.selectedDates[1], 'Y-m-d') : '';
                        d.status = $('#status').val();
                    },
                }, 
                columns: [
                    { 
                        data: 'id',
                        name: 'id'
                    },
                    { 
                        data: 'invoice_number',
                        name: 'invoice_number'
                    },
                    { 
                        data: null,
                        render: function(data, type, row, meta){
                            return `<span class="badge badge-${row.order_status_color}">${row.status_label}</span>`;
                        }
                    },
                    { 
                        data: 'created_at',
                        name: 'created_at'
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
            $('div.head-label').html('<h6 class="mb-0">Data Order</h6>');


        

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
            $('#status').prop('selectedIndex', 0);
            table.draw();
        })

        $('#filter').click(function () {
            table.draw();
        })

    })
</script>
@endpush