@extends('layout.main') @section('content')
<div class="container-fluid">
    <h2>Edit Book</h2>
    <form
        action="/edit-buku/{{ $buku->id }}"
        method="post"
        enctype="multipart/form-data"
    >
        @csrf
        <div>
            <label for="judul">Judul</label>
            <input
                class="form-control @error('judul') is-invalid @enderror"
                type="text"
                name="judul"
                value="{{ $buku->judul }}"
            />
            @error('judul')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label for="deskripsi">deskripsi</label>
            <input
                class="form-control @error('deskripsi') is-invalid @enderror"
                type="text"
                name="deskripsi"
                value="{{ $buku->deskripsi }}"
            />
            @error('deskripsi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label for=" jumlah">jumlah</label>
            <input
                class="form-control @error('jumlah') is-invalid @enderror"
                type="text"
                name="jumlah"
                value="{{ $buku->jumlah }}"
            />
            @error('jumlah')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label for="file">file</label>
            <input
                class="form-control @error('file') is-invalid @enderror"
                type="text"
                name="file"
                value="{{ $buku->file }}"
            />
            @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <label for=" kategori_id">kategori</label>
            <select
                name="kategori_id"
                id="kategori_id"
                class="form-control @error('kategori_id') is-invalid @enderror"
            >
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
        <div>
            <label for="cover">cover</label>
            <input
                class="form-control mb-2 @error('cover') is-invalid @enderror"
                type="file"
                name="cover"
            />
            @if($buku->cover)
            <img src="{{ url('img/'. $buku->cover) }}" width="150px" />
            @else
            <p>-</p>
            @endif
        </div>
        @error('cover')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <button class="btn btn-primary mt-2" type="submit">save</button>
    </form>
</div>
@endsection
