@extends('layout.main') @section('content')
<div class="container-fluid d-flex justify-content-between">
    <div>
        <h2>Buku</h2>
        <p>Menu / Buku</p>
    </div>
    <div class="d-flex align-items-center">
        <form action="/cari-buku/{{ $userLogin }}" method="post">
            <div class="d-flex">
                @csrf
                <div class="d-flex">
                    <input class="form-control" type="text" name="cari" />
                    <button class="btn btn-primary mx-1" type="submit">
                        <i class="fas fa-magnifying-glass"></i>
                    </button>
                </div>
                <div>
                    <button
                        class="btn btn-secondary"
                        type="button"
                        onclick="hide()"
                    >
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
            <div style="display: none" id="filter">
                <label for="kategori">Filter Kategori</label>
                @foreach ($kategori as $k)
                <div class="form-check">
                    <input
                        type="checkbox"
                        name="kategori[]"
                        value="{{ $k->id }}"
                    />
                    <label for="kategori">{{ $k->nama}}</label>
                </div>
                @endforeach
            </div>
        </form>
    </div>
</div>
<div class="container-fluid mt-4">
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
    <div class="alert alert-danger mt-3">
        {{ Session::get('delete') }}
    </div>
    @endif @if (Session::has('error'))
    <div class="alert alert-danger mt-3">
        {{ Session::get('error') }}
    </div>
    @endif

    <div class="d-flex justify-content-between">
        <div>
            <a class="btn btn-primary" href="/add-buku">Tambah Buku</a>
        </div>
    </div>
    <table class="table table-hover table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <td class="number">No.</td>
                <td>judul</td>
                <td>deskripsi</td>
                <td>jumlah</td>
                <td>kategori</td>
                <td>cover</td>
                @if(Auth::user()->isAdmin())
                <td>Author</td>
                @endif
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($buku as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->deskripsi }}</td>
                <td>{{ $b->jumlah }}</td>
                <td>{{ $b->kategori->nama}}</td>
                <td>
                    @if($b->cover == null)
                    <p>-</p>
                    @else
                    <img src="{{ url('img/'.$b->cover) }}" width="150px" />
                    @endif
                </td>
                @if(Auth::user()->isAdmin())
                <td>{{ $b->user->nama }}</td>
                @endif
                <td class="action">
                    <a class="btn btn-warning" href="/edit-buku/{{ $b->id }}"
                        ><i class="far fa-pen-to-square"></i
                    ></a>
                    <a
                        class="btn btn-danger"
                        href="/hapus-buku/{{ $b->id }}"
                        onclick="return confirm('Hapus data {{ $b->judul }} ?')"
                    >
                        <i class="far fa-trash-can"></i>
                    </a>
                    <a class="btn btn-success" href="/show-pdf/{{ $b->id }}"
                        ><i class="far fa-file-pdf"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
