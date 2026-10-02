@extends('layouts.app')
@section('title', 'Daftar Kegiatan')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h1 style="font-size:1.5rem;">Daftar Kegiatan</h1>
    <a href="{{ route('activities.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

{{-- Filter & Search --}}
<form method="GET" action="{{ route('activities.index') }}" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px;">
    <input name="search" value="{{ request('search') }}" placeholder="Cari judul / kode..." style="width:200px;">
    <select name="category_id" style="width:auto;">
        <option value="">Semua Kategori</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    <select name="status" style="width:auto;">
        <option value="">Semua Status</option>
        @foreach (['draft','published','completed'] as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <select name="sort" style="width:auto;">
        <option value="newest" @selected(request('sort','newest') === 'newest')>Terbaru</option>
        <option value="oldest" @selected(request('sort') === 'oldest')>Terlama</option>
    </select>
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="{{ route('activities.index') }}" class="btn btn-secondary">Reset</a>
</form>

@forelse ($activities as $activity)
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h2 style="font-size:1rem; margin-bottom:4px;">
                    <a href="{{ route('activities.show', $activity) }}" style="text-decoration:none; color:#1e3a5f;">
                        [{{ $activity->code }}] {{ $activity->title }}
                    </a>
                </h2>
                <p style="color:#6b7280; font-size:0.85rem;">
                    {{ $activity->category->name }} &nbsp;|&nbsp;
                    {{ $activity->start_at?->format('d M Y') ?? '-' }}
                    &nbsp;|&nbsp; Kapasitas: {{ $activity->registered_count }}/{{ $activity->capacity }}
                </p>
            </div>
            <span class="badge badge-{{ $activity->status }}">{{ ucfirst($activity->status) }}</span>
        </div>
    </div>
@empty
    <div class="card" style="text-align:center; color:#6b7280;">Belum ada kegiatan.</div>
@endforelse

<div style="margin-top:12px;">{{ $activities->links() }}</div>
@endsection
