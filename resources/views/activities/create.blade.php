@extends('layouts.app')

@section('title', 'Tambah Kegiatan')

@section('content')
<div style="margin-bottom:16px;">
    <a href="{{ route('activities.index') }}" style="color:#1e3a5f; text-decoration:none;">← Kembali ke Daftar</a>
</div>

<div class="card">
    <h1 style="font-size:1.4rem; margin-bottom:20px;">Tambah Kegiatan Baru</h1>

    <form method="POST" action="{{ route('activities.store') }}">
        @csrf

        @include('activities._form')

        <div class="actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary">Simpan Kegiatan</button>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
