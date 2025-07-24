@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <?php $segments = ''; ?>
                            @for ($i = 1; $i <= count(Request::segments()); $i++)
                                <?php $segments .= '/' . Request::segment($i); ?>
                                @if ($i < count(Request::segments()))
                                    <li class="breadcrumb-item text-capitalize">{{ Request::segment($i) }}</li>
                                @else
                                    <li class="breadcrumb-item text-capitalize active">{{ Request::segment($i) }}</li>
                                @endif
                            @endfor
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="animated fadeIn">

                <!-- PASTIKAN MENGIRIMKAN ID PADA ROUTE YANG DIGUNAKAN -->
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- KARENA UPDATE MAKA KITA GUNAKAN DIRECTIVE DIBAWAH INI -->
                    @method('PUT')

                    <!-- FORM INI SAMA DENGAN CREATE, YANG BERBEDA HANYA ADA TAMBAHKAN VALUE UNTUK MASING-MASING INPUTAN  -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Produk</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nama Produk</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $product->name }}" required>
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="1" {{ $product->status == '1' ? 'selected' : '' }}>Publish
                                            </option>
                                            <option value="0" {{ $product->status == '0' ? 'selected' : '' }}>Draft
                                            </option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('status') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Kategori</label>
                                        <select name="category_id" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($category as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ $product->category_id == $row->id ? 'selected' : '' }}>
                                                    {{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Harga Normal</label>
                                        <input type="text" name="price" class="form-control number"
                                            value="{{ $product->price }}" required>
                                        <p class="text-danger">{{ $errors->first('price') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="price_discount">Harga Diskon</label>
                                        <input type="text" name="price_discount" class="form-control number"
                                            value="{{ $product->price_discount }}" required>
                                        <p class="text-danger">{{ $errors->first('price_discount') }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">Stok</label>
                                        <input type="number" name="stock" class="form-control"
                                            value="{{ $product->stock }}" required>
                                        <p class="text-danger">{{ $errors->first('stock') }}</p>
                                    </div>

                                    <!-- GAMBAR TIDAK LAGI WAJIB, JIKA DIISI MAKA GAMBAR AKAN DIGANTI, JIKA DIBIARKAN KOSONG MAKA GAMBAR TIDAK AKAN DIUPDATE -->
                                    <div class="form-group">
                                        <label for="image">Foto Produk</label>
                                        <br>
                                        <!--  TAMPILKAN GAMBAR SAAT INI -->
                                        <img src="{{ asset('products/' . $product->image) }}" width="100px" height="100px"
                                            alt="{{ $product->name }}">
                                        <hr>
                                        <input type="file" name="image" class="form-control">
                                        <p><strong>Biarkan kosong jika tidak ingin mengganti gambar</strong></p>
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('page-styles')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('page-scripts')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
