@extends('layouts.app')
@section('title', 'Tambah Kegiatan')
@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('activities.index') }}" style="color:#1e3a5f;">← Kembali</a>
</div>

<div class="card">
    <h1 style="font-size:1.3rem; margin-bottom:20px;">Tambah Kegiatan</h1>
    <form method="POST" action="{{ route('activities.store') }}">
        @csrf
        @include('activities._form', ['activity' => new App\Models\Activity])
        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
