@extends('layout.main')@section('content')
<div class="container-fluid">
    <h2>Register</h2>
    <p>Admin / Register</p>
</div>
<div class="container-fluid mt-4">
    <div>
        <a href="/add-user" class="btn btn-primary">Tambah User</a>
    </div>
    <table class="table table-hover table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <td class="number">no</td>
                <td>nama</td>
                <td>email</td>
                <td>role</td>
                <td>action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $u)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $u->nama }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role->nama }}</td>
                <td class="action">
                    <a class="btn btn-warning" href="/edit-user/{{ $u->id }}"><i class="far fa-pen-to-square"></i></a>
                    <a class="btn btn-danger" href="/hapus-user/{{ $u->id }}"
                        onclick="return confirm('Hapus data {{ $u->nama }} ?')"><i class="far fa-trash-can"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection