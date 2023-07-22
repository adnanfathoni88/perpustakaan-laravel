@extends('layout.main') @section('content')
<div class="container-fluid">
    <h2>Edit user</h2>
</div>
<div class="container-fluid mt-4">
    <form action="/edit-user/{{$user->id}}" method="post">
        @csrf
        <div class="form-outline">
            <input class="form-control form-control-lg" type="text" name="nama" id="form12" value="{{ $user->nama }}" />
            <label class="form-label" for="form12">nama</label>
        </div>
        <div class="form-outline">
            <input class="form-control form-control-lg" type="email" name="email" id="form12"
                value="{{ $user->email }}" />
            <label class="form-label" for="form12">email</label>
        </div>
        <div class="form-outline">
            <input class="form-control form-control-lg" type="password" name="password" id="form12" />
            <label class="form-label" for="form12">password</label>
        </div>
        <div class="mb-4">
            <select name="role_id" id="role_id"
                class="form-control form-control-lg @error('role_id') is-invalid @enderror">
                <option value="{{ $user->role->id }}">-- {{ $user->role->nama }} --</option>
                @foreach ($role as $r)
                <option value="{{$r->id}}">{{$r->nama}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary mt-2" type="submit">save</button>
    </form>
</div>
@endsection