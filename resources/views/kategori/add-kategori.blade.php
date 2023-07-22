@extends('layout.main') @section('content')
<div class="container-fluid">
    <h2>Add Kategori</h2>
</div>
<div class="container-fluid mt-4">
    <form action="/add-kategori" method="post">
        @csrf
        <div class="form-outline">
            <input class="form-control form-control-lg @error('nama') is-invalid @enderror" id="form12" type="text"
                name="nama" />
            <label class="form-label" for="form12">nama</label>
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-outline">
            <input class="form-control form-control-lg @error('deskripsi') is-invalid @enderror" id="form12" type="text"
                name="deskripsi" />
            <label class="form-label" for="form12">deskripsi</label>
            @error('deskripsi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">save</button>
    </form>
</div>
@endsection