@extends('layouts.app')
@section('title', 'Edit Kegiatan')
@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('activities.show', $activity) }}" style="color:#1e3a5f;">← Kembali</a>
</div>

<div class="card">
    <h1 style="font-size:1.3rem; margin-bottom:20px;">Edit Kegiatan</h1>
    <form method="POST" action="{{ route('activities.update', $activity) }}">
        @csrf @method('PUT')
        @include('activities._form')
        <div class="actions">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('activities.show', $activity) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
