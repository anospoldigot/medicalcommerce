@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Transaction</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transaction</a>
            </li>
            <li class="breadcrumb-item active">Report
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Generate Report</h4>
            </div>
            <div class="card-body">
                <h6><label for="">Filter</label></h6>
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
                            <input type="text" name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount"
                                oninput="currencyInput()">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Max Amount</label>
                            <input type="text" name="max_amount" id="max_amount" class="form-control" placeholder="Min Amount"
                                oninput="currencyInput()">
                        </div>
                    </div>
                    <div class="col-12">
                        <small class="text-primary">Note: Kosongkan jika tidak ingin memakai filter</small>
                    </div>
                    <div class="col-12 text-right">
                        <button class="btn btn-outline-primary" id="reset-filter"><i data-feather='refresh-cw' class="mr-1"></i>Clear</button>
                    </div>
                </div>
                <hr class="my-2">
                <div class="mb-1">
                    @if ($hasExcel)
                    <button onclick="generateExcel()" class="btn btn-success">Regenerate Report (Excel)</button>
                    <a href="{{ route('transactions.report.excel') }}" class="btn btn-success">Download (Excel)</a>
                    @else
                    <button onclick="generateExcel()" class="btn btn-success">Generate Report (Excel)</button>
                    @endif
                </div>
                <div class="mb-3">
                    @if ($hasPdf)
                    <button onclick="generatePdf()" class="btn btn-danger">Regenerate Report (Pdf)</button>
                    <a href="{{ route('transactions.report.pdf') }}" class="btn btn-danger">Download (Pdf)</a>
                    @else
                    <button onclick="generatePdf()" class="btn btn-danger">Generate Report (Pdf)</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var picker = flatpickr('#date_range', {
        mode: 'range',
        dateFormat: 'Y-m-d',
        onClose: function(selectedDates, dateStr, instance) {

        }
    });
    
    function generateExcel (){
            $.ajax({
                url: '{{ route("transactions.report.excel.generate") }}',
                method: 'GET',
                data: {
                    start_date: picker.selectedDates[0] ? picker.formatDate(picker.selectedDates[0], 'Y-m-d') : '',
                    end_date : picker.selectedDates[1]  ? picker.formatDate(picker.selectedDates[1], 'Y-m-d') : '',
                },
                success: function(res){
                    if(res.success){
                        toastr['success'](res.message, 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
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
        
    function generatePdf (){
            $.ajax({
                url: '{{ route("transactions.report.pdf.generate") }}',
                method: 'GET',
                success: function(res){
                    if(res.success){
                        toastr['success'](res.message, 'Success!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
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

        $('#reset-filter').click(function () {
            picker.clear();
            $('#min_amount').val('');
            $('#max_amount').val('');
        })
</script>
@endpush