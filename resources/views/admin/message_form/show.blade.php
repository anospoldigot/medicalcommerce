@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Message Form</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Message Form</a>
            </li>
            <li class="breadcrumb-item active">Show
            </li>
        </ol>
    </div>
</div>
@endsection


@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <p>
                            {{ $message_form->name }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <p>
                            {{ $message_form->email }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Subject</label>
                        <p>
                            {{ $message_form->subject }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <p>
                            {{ $message_form->message }}
                        </p>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('message_forms.index') }}" class="btn btn-outline-primary">
                            <i data-feather='corner-up-left' class="mr-1"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection