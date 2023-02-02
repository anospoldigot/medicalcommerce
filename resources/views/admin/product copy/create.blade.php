@extends('layouts.app')

@section('breadcrumb')
<div class="col-12">
    <h2 class="content-header-title float-left mb-0">Product</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="breadcrumb-item active">Create
            </li>
        </ol>
    </div>
</div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" id="create-product">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="title">Nama Product</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Name" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option value="" selected disabled>==PILIH==</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id')) >{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" oninput="currencyInput()" value="{{ old('price') }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="Stock" value="{{ old('stock') }}">
                        </div>
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="weight">Berat</label>
                            <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" placeholder="Berat (Gram)" value="{{ old('weight') }}">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col">
                        <div class="form-group">
                            <div class="custom-control custom-control-primary custom-switch">
                                <input type="checkbox" {{ old('discount')==1 ? 'checked' : '' }} value="1" class="custom-control-input"
                                    id="is_discount" name="is_discount" />
                                <label class="custom-control-label" for="is_discount">Discount</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="custom-control custom-control-primary custom-switch">
                                <input type="checkbox"  value="1" class="custom-control-input"
                                    id="is_front" name="is_front" />
                                <label class="custom-control-label" for="is_front">Show in Landing Page</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="detail-discount">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="discount_type">Discount Type</label>
                            <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror" id="discount_type">
                                <option value="" selected disabled>==PILIH==</option>
                                <option value="persen">Persen</option>
                                <option value="nominal">Nominal</option>
                            </select>
                            @error('discount_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="discount">Discount Value</label>
                            <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount"
                                placeholder="Discount" value="{{ old('discount') }}">
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="description">Deskripsi Product</label>
                            <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="images">Gambar Product</label>
                            
                            {{-- <input type="file" name="images" id="images" class="form-control-file" multiple> --}}
                            <div id="output-image"></div>
                            @error('images')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('product.index') }}" class="btn btn-outline-primary"><i data-feather='corner-up-left'></i> Batal</a>
                    <button type="button" id="form-submit" class="btn btn-primary"><i data-feather='save'></i> Tambah</button>
                    <button type="submit" class="btn btn-primary d-none"><i data-feather='save'></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        @if (old('is_discount') == 1)
            $('#detail-discount').show();
        @else
            $('#detail-discount').hide();
        @endif



        $('#description').summernote({
            placeholder: 'Alamat',
            tabsize: 2,
            height: 120,
            toolbar: [
            ['font', ['bold', 'underline', 'clear', 'italic']],
            ]
        });
        $('#output-image').imageUploader();


        $('#discount').on('input', function(){
            if($('#discount_type').val() == 'persen'){
                const prev = $(this).data('val');
                if(event.target.value > 100){
                    event.preventDefault();
                    alert('persen tidak bisa diatas 100');
                }else{
                    const value = event.target.value.replace(/[^\d]/g, "")
                    event.target.value = value;
                }
            }else if($('#discount_type').val() == 'nominal'){
                const value = event.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                event.target.value = numeral(value).format('0,0');
            }else{
                alert('Masukkan tipe discount dahulu');
                event.target.value = '';
            }
        });

        $('#is_discount').change(function(){
            if($('#is_discount').is(':checked')){
                $('#detail-discount').show();
            }else{
                $('#detail-discount').hide();
            }
        })
        $('#form-submit').click(function(){
            let html = '';
            const data = $('#create-product').serializeArray();
            console.log(data);

            html += `
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <small><b>Nama Product</b></small>
                        </div>
                        <div class="col-6 col-lg-8">
                            : ${$('#title').val()}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <small><b>Harga</b></small>
                        </div>
                        <div class="col-6 col-lg-8">
                            : Rp. ${$('#price').val()}
                        </div>
                    </div>
                    <hr>

            `
            if($('#is_discount').is(':checked')){
                let price; 
                if($('#discount_type').val() == 'persen'){
                    price = (parseInt($('#price').val().replace(/,/g, '')) / 100) * $('#discount').val()
                }else if($('#discount_type').val() == 'nominal'){
                    price = parseInt($('#price').val().replace(/,/g, '')) - parseInt($('#discount').val().replace(/,/g, ''))
                }
                console.log($('#price').val().replace(/,/g, ''))
                html += `
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <small><b>Harga Setelah Discount</b></small>
                        </div>
                        <div class="col-6 col-lg-8">
                            : Rp. ${numeral(price).format('0,0')}
                        </div>
                    </div>
                    <hr>
                `
            }

            Swal.fire({
                title: '<strong>Ringkasan Product</strong>',
                icon: 'info',
            
                html: `<div class="container">${html}</div>`,
                // html:
                // 'You can use <b>bold text</b>, ' +
                // '<a href="//sweetalert2.github.io">links</a> ' +
                // 'and other HTML tags',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tambah Product',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#create-product').submit()
                }
            })
        });

    </script>
@endpush