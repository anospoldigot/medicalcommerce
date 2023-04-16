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
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Generate Report</h4>
            </div>
            <div class="card-body">

                <div class="mb-3">
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
    function generateExcel (){
            $.ajax({
                url: '{{ route("transactions.report.excel.generate") }}',
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
</script>
@endpush