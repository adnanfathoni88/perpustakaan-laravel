@extends('layout.main') @section('content')
<div class="container-fluid">
    <h2>Tambah Buku</h2>
</div>
<div class="container-fluid">
    <form action="/add-buku" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-outline">
            <input
                class="form-control form-control-lg @error('judul') is-invalid @enderror"
                id="form12"
                type="text"
                name="judul"
            />
            <label class="form-label" for="form12">Judul</label>
            @error('judul')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-outline">
            <input
                class="form-control form-control-lg @error('deskripsi') is-invalid @enderror"
                id="form12"
                type="text"
                name="deskripsi"
            />
            <label class="form-label" for="form12">deskripsi</label>
            @error('deskripsi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-outline">
            <input
                class="form-control form-control-lg @error('jumlah') is-invalid @enderror"
                id="form12"
                type="text"
                name="jumlah"
            />
            <label class="form-label" for="form12">jumlah</label>
            @error('jumlah')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            <select
                name="kategori_id"
                id="kategori_id"
                class="form-control form-control-lg @error('kategori_id') is-invalid @enderror"
            >
                <option value="">-- kategori --</option>
                @foreach ($kategori as $k)
                <option value="{{$k->id}}">{{$k->nama}}</option>
                @endforeach
            </select>
            <!-- notif error -->
            @error('kategori_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-file">
            <label for="cover">cover</label>
            <input
                class="form-control form-control-lg @error('cover') is-invalid @enderror"
                type="file"
                id="formFileLg"
                name="cover"
            />
            @error('cover')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-file">
            <label for="file">file</label>
            <input
                class="form-control form-control-lg @error('file') is-invalid @enderror"
                type="file"
                id="formFileLg"
                name="file"
            />
            @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button class="btn btn-primary mt-2 w-100 h-2" type="submit">
            save
        </button>
    </form>
</div>
@endsection
