@extends('layouts.app')

@section('title', 'Edit: ' . $activity->title)

@section('content')
<div style="margin-bottom:16px;">
    <a href="{{ route('activities.show', $activity) }}" style="color:#1e3a5f; text-decoration:none;">← Kembali ke Detail</a>
</div>

<div class="card">
    <h1 style="font-size:1.4rem; margin-bottom:20px;">Edit Kegiatan</h1>

    <form method="POST" action="{{ route('activities.update', $activity) }}">
        @csrf
        @method('PUT')

        @include('activities._form')

        <div class="actions" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('activities.show', $activity) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
