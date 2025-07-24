@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Daftar Kategori</h1>
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

                    <!-- BAGIAN INI AKAN MENG-HANDLE FORM INPUT NEW CATEGORY  -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kategori Baru</h4>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('category.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Kategori</label>
                                        <input type="text" name="name" class="form-control" required>
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    {{-- <div class="form-group">
                                    <label for="parent_id">Kategori</label>
                                      <!-- VARIABLE $PARENT PADA METHOD INDEX KITA GUNAKAN DISINI -->
                                    <!-- UNTUK MENAMPILKAN DATA CATEGORY YANG PARENT_ID NYA NULL -->
                                    <!-- UNTUK DIPILIH SEBAGAI PARENT TAPI SIFATNYA OPTIONAL -->
                                    <select name="parent_id" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($parent as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div> --}}
                                    @if (Auth::user()->role == 'admin')
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Tambah</button>
                                        </div>
                                    @endif
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- BAGIAN INI AKAN MENG-HANDLE FORM INPUT NEW CATEGORY  -->

                    <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST CATEGORY  -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List Kategori</h4>
                            </div>
                            <div class="card-body">
                                <!-- KETIKA ADA SESSION SUCCESS  -->
                                @if (session('success'))
                                    <!-- MAKA TAMPILKAN ALERT SUCCESS -->
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <!-- KETIKA ADA SESSION ERROR  -->
                                @if (session('error'))
                                    <!-- MAKA TAMPILKAN ALERT DANGER -->
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kategori</th>
                                                {{-- <th>Parent</th> --}}
                                                <th>Created At</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- LOOPING DATA KATEGORI SESUAI JUMLAH DATA YANG ADA DI VARIABLE $CATEGORY -->
                                            @forelse ($category as $val)
                                                <tr>
                                                    <td></td>
                                                    <td><strong>{{ $val->name }}</strong></td>

                                                    <!-- MENGGUNAKAN TERNARY OPERATOR, UNTUK MENGECEK, JIKA $val->parent ADA MAKA TAMPILKAN NAMA PARENTNYA, SELAIN ITU MAKA TANMPILKAN STRING - -->
                                                    {{-- <td>{{ $val->parent ? $val->parent->name:'-' }}</td> --}}

                                                    <!-- FORMAT TANGGAL KETIKA KATEGORI DIINPUT SESUAI FORMAT INDONESIA -->
                                                    <td>{{ $val->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        @if (Auth::user()->role == 'admin')
                                                            <form action="{{ route('category.destroy', $val->id) }}"
                                                                method="post">
                                                                <!-- KONVERSI DARI @ CSRF & @ METHOD AKAN DIJELASKAN DIBAWAH -->
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="{{ route('category.edit', $val->id) }}"
                                                                    class="btn btn-warning btn-sm">Edit</a>
                                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <!-- JIKA DATA CATEGORY KOSONG, MAKA AKAN DIRENDER KOLOM DIBAWAH INI  -->
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- FUNGSI INI AKAN SECARA OTOMATIS MEN-GENERATE TOMBOL PAGINATION  -->
                                {!! $category->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST CATEGORY  -->
                </div>
            </div>
        </section>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('js')
    <script>
        console.log('Hi!');
    </script>
@endsection
