@extends('layout.main') @section('content')
<div class="container-fluid">
    <h1>welcome {{ $user->nama}}</h1>

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session("error") }}
    </div>
</div>
@endif @endsection
