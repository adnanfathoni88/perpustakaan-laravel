@extends('layout.main') @section('content')
<div class="container-fluid">
    <h2>Tambah User</h2>
    <p>Admin / Tambah User</p>
</div>
<div class="container-fluid mt-4">
    <form action="/add-user" method="post">
        @csrf
        <div class="form-outline">
            <input class="form-control form-control-lg" type="text" name="nama" id="form12" />
            <label class="form-label" for="form12">Nama</label>
        </div>
        <div class="form-outline">
            <input class="form-control form-control-lg" type="email" name="email" id="form12" />
            <label class="form-label" for="form12">e-mail</label>
        </div>
        <div class="form-outline">
            <input class="form-control form-control-lg" type="password" name="password" id="form12" />
            <label class="form-label" for="form12">Password</label>
        </div>
        <div class="mb-4">
            <select name="role_id" id="role_id"
                class="form-control form-control-lg @error('role_id') is-invalid @enderror">
                <option value="#">-- role --</option>
                @foreach ($role as $r)
                <option value="{{$r->id}}">{{$r->nama}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
    </form>
</div>
@endsection