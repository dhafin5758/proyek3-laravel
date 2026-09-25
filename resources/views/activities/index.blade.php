@extends('layouts.app')

@section('title', 'Daftar Kegiatan')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h1 style="font-size:1.6rem;">Daftar Kegiatan</h1>
    <a href="{{ route('activities.create') }}" class="btn btn-primary">+ Tambah Kegiatan</a>
</div>

{{-- Filter --}}
<form method="GET" action="{{ route('activities.index') }}" style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px;">
    <select name="status" style="width:auto; min-width:150px;">
        <option value="">Semua Status</option>
        @foreach (['Planned', 'Ongoing', 'Done'] as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ $s }}</option>
        @endforeach
    </select>
    <select name="category" style="width:auto; min-width:150px;">
        <option value="">Semua Kategori</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="{{ route('activities.index') }}" class="btn btn-secondary">Reset</a>
</form>

@forelse ($activities as $activity)
    @php
        $badgeClass = match($activity->status) {
            'Planned' => 'badge-planned',
            'Ongoing' => 'badge-ongoing',
            'Done'    => 'badge-done',
            default   => '',
        };
    @endphp
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px;">
            <div>
                <h2 style="font-size:1.1rem; margin-bottom:4px;">
                    <a href="{{ route('activities.show', $activity) }}" style="text-decoration:none; color:#1e3a5f;">
                        {{ $activity->title }}
                    </a>
                </h2>
                <p style="color:#6b7280; font-size:0.88rem;">
                    {{ $activity->activity_date->format('d M Y') }} &nbsp;|&nbsp;
                    {{ $activity->category }}
                </p>
            </div>
            <span class="badge {{ $badgeClass }}">{{ $activity->status }}</span>
        </div>
    </div>
@empty
    <div class="card" style="text-align:center; color:#6b7280;">
        <p>Belum ada kegiatan yang tersedia.</p>
    </div>
@endforelse
@endsection
