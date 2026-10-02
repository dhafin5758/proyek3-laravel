@extends('layouts.app')
@section('title', 'Tambah Kategori')
@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('categories.index') }}" style="color:#1e3a5f;">← Kembali</a>
</div>

<div class="card" style="max-width:500px;">
    <h1 style="font-size:1.3rem; margin-bottom:20px;">Tambah Kategori</h1>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input id="name" name="name" value="{{ old('name') }}">
            @error('name') <p class="error-msg">{{ $message }}</p> @enderror
        </div>
        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
