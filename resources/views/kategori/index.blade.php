@extends('layout.main') @section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <div>
            <h2>Kategori</h2>
            <p>Menu / Kategori</p>
        </div>
        <div class="d-flex justify-content-between align-items-center ">
            <form action="/cari" method="post">
                @csrf
                <div class="d-flex">
                    <input class="form-control" type="text" name="cari" />
                    <button class="btn btn-primary mx-1" type="submit">
                        <i class="fas fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid mt-4">
    <div>
        <a class="btn btn-primary" href="/add-kategori">Tambah Kategori</a>
    </div>
    <!-- flash message -->
    @if (Session::has('insert'))
    <div class="alert alert-success mt-3">
        {{ Session::get('insert') }}
    </div>
    @endif @if (Session::has('update'))
    <div class="alert alert-success mt-3">
        {{ Session::get('update') }}
    </div>
    @endif @if (Session::has('delete'))
    <div class="alert alert-danger mt-3">v
        {{ Session::get('delete') }}
    </div>
    @endif

    <table class="table table-hover table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <td class="number">No.</td>
                <td>Nama</td>
                <td>deskripsi</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->deskripsi }}</td>
                <td class="action">
                    <a class="btn btn-warning" href="/edit-kategori/{{ $k->id }}"><i
                            class="far fa-pen-to-square"></i></a>
                    <a class="btn btn-danger" href="/hapus-kategori/{{ $k->id }}"
                        onclick="return confirm('Hapus data {{ $k->nama }} ?')">
                        <i class="far fa-trash-can"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection