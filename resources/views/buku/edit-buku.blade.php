@extends('layout.main') @section('content')
<div class="container-fluid">
    <h2>Edit Buku</h2>
</div>
<div class="form-group d-flex justify-content-between">
    <div class="form">
        <form action="/edit-buku/{{ $buku->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-outline">
                <input class="form-control form-control-lg" type="text" name="judul" id="form12"
                    value="{{ $buku->judul }}" />
                <label class="form-label" for="form12">Judul</label>
            </div>
            <div class="form-outline">
                <input class="form-control form-control-lg" type="text" name="deskripsi" id="form12"
                    value="{{ $buku->deskripsi }}" />
                <label class="form-label" for="form12">Deskripsi</label>
            </div>
            <div class="form-outline">
                <input class="form-control form-control-lg" type="text" name="jumlah" id="form12"
                    value="{{ $buku->jumlah }}" />
                <label class="form-label" for="form12">Jumlah</label>
            </div>
            <div class="mb-2">
                <select name="kategori_id" id="kategori_id" class="form-control form-control-lg">
                    <option value="{{ $buku->kategori_id }}">-- {{ $buku->kategori->nama }} --</option>
                    @foreach ($kategori as $k)
                    <option value="{{$k->id}}">{{$k->nama}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="cover">cover</label>
                <input class="form-control mb-2 @error('cover') is-invalid @enderror" type="file" name="cover" />
                @error('cover')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label for="file">file</label>
                <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" />
                @error('file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <button class="btn btn-primary mt-4 w-100" type="submit">simpan</button>
        </form>
    </div>
    <div class="form">
        <h2>Preview</h2>
        <div class="pdf-preview mt-2">
            <div>
                <p>Cover</p>
                @if($buku->cover)
                <img class="cover-preview" src="{{ url('img/'. $buku->cover) }}" width="500px" height="300px" />
                @else
                <p>-</p>
                @endif
            </div>
            <hr>
            <div class="mt-2">
                <p>File </p>
                <iframe src="{{ asset('storage/pdfs/' . $buku->file) }}" frameborder="0" width="500px "
                    height="600px"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection