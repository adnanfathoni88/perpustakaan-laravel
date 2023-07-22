@extends('layout.main') @section('content')
<div class="container-fluid">
    <h2>Edit Kategori</h2>
</div>
<div class="container-fluid">
    <form action="/edit-kategori/{{ $kategori->id }}" method="post">
        @csrf
        <div class="">
            <label for="nama">nama</label>
            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                value="{{ $kategori->nama }}" />
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label for="deskripsi">deskripsi</label>
            <input class="form-control @error('deskripsi') is-invalid @enderror" type="text" name="deskripsi"
                value="{{ $kategori->deskripsi }}" />
            @error('deskripsi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button class="btn btn-primary mt-2" type="submit">save</button>
    </form>
</div>
@endsection