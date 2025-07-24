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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Kategori</h4>
                            </div>
                            <div class="card-body">
                                <!-- ROUTINGNYA MENGIRIMKAN ID CATEGORY YANG AKAN DIEDIT -->
                                <form action="{{ route('category.update', $category->id) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Kategori</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $category->name }}" required>
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="parent_id">Kategori</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($parent as $row)
                                      
                                      	<!-- TERDAPAT TERNARY OPERATOR UNTUK MENGECEK JIKA PARENT_ID SAMA DENGAN ID CATEGORY PADA LIST PARENT, MAKA OTOMATIS SELECTED -->
                                        <option value="{{ $row->id }}" {{ $category->parent_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div> --}}
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
