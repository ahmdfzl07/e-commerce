@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Daftar Produk</h1>
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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    List Product
                                </h4>
                                <div class="d-flex justify-content-end">
                                    {{-- <a href="{{ route('product.bulk') }}" class="btn btn-danger btn-sm">Mass Upload</a> --}}
                                    @if (Auth::user()->role == 'admin')
                                        <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body"style="background-color;red">
                                <!-- JIKA TERDAPAT FLASH SESSION, MAKA TAMPILAKAN -->
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <!-- TABLE UNTUK MENAMPILKAN DATA PRODUK -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered datatableAutoNumeric">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Foto</th>
                                                <th>Produk</th>
                                                <th>Harga Normal</th>
                                                <th>Harga Diskon</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $row)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        <!-- TAMPILKAN GAMBAR DARI FOLDER PUBLIC/STORAGE/PRODUCTS -->
                                                        <img src="{{ asset('products/' . $row->image) }}" width="100px"
                                                            height="100px" alt="{{ $row->name }}">
                                                    </td>
                                                    <td>
                                                        <strong>{{ $row->name }}</strong><br>
                                                        <!-- ADAPUN NAMA KATEGORINYA DIAMBIL DARI HASIL RELASI PRODUK DAN KATEGORI -->
                                                        <label>Kategori: <span
                                                                class="badge badge-info">{{ $row->category->name }}</span></label><br>
                                                        <label>Stok: <span
                                                                class="badge badge-info">{{ $row->stock }}</span></label>
                                                    </td>
                                                    <td>Rp {{ number_format($row->price) }}</td>
                                                    <td>Rp {{ number_format($row->price_discount) ?? 0 }}</td>
                                                    <td>{{ $row->created_at->format('d M Y') }}</td>

                                                    <!-- KARENA BERISI HTML MAKA KITA GUNAKAN { !! UNTUK MENCETAK DATA -->
                                                    <td>{!! $row->status_label !!}</td>
                                                    <td>
                                                        @if (Auth::user()->role == 'admin')
                                                            <form action="{{ route('product.destroy', $row->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="{{ route('product.edit', $row->id) }}"
                                                                    class="btn btn-warning btn-sm">Edit</a>
                                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('page-styles')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('page-scripts')
    <script>
        function getUsers() {
            fetch('/users-second-db')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        let users = data.data;
                        let userList = document.getElementById('userList');
                        userList.innerHTML = '';

                        users.forEach(user => {
                            let li = document.createElement('li');
                            li.textContent = user.name; // Sesuaikan dengan field di database
                            userList.appendChild(li);
                        });
                    } else {
                        alert('Gagal mengambil data');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
