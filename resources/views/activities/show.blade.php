@extends('layouts.app')
@section('title', $activity->title)
@section('content')

<div style="margin-bottom:16px;">
    <a href="{{ route('activities.index') }}" style="color:#1e3a5f;">← Kembali</a>
</div>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
        <div>
            <h1 style="font-size:1.4rem;">{{ $activity->title }}</h1>
            <p style="color:#6b7280; font-size:0.85rem;">{{ $activity->code }}</p>
        </div>
        <span class="badge badge-{{ $activity->status }}">{{ ucfirst($activity->status) }}</span>
    </div>

    <table style="margin-bottom:20px;">
        <tr><td style="color:#6b7280; width:140px; padding:6px 0; font-weight:600;">Kategori</td><td>{{ $activity->category->name }}</td></tr>
        <tr><td style="color:#6b7280; padding:6px 0; font-weight:600;">Lokasi</td><td>{{ $activity->location ?? '-' }}</td></tr>
        <tr><td style="color:#6b7280; padding:6px 0; font-weight:600;">Mulai</td><td>{{ $activity->start_at?->format('d M Y H:i') ?? '-' }}</td></tr>
        <tr><td style="color:#6b7280; padding:6px 0; font-weight:600;">Selesai</td><td>{{ $activity->end_at?->format('d M Y H:i') ?? '-' }}</td></tr>
        <tr><td style="color:#6b7280; padding:6px 0; font-weight:600;">Kapasitas</td><td>{{ $activity->registered_count }} / {{ $activity->capacity }}</td></tr>
        <tr><td style="color:#6b7280; padding:6px 0; font-weight:600;">Deskripsi</td><td>{{ $activity->description ?? '-' }}</td></tr>
    </table>

    <div class="actions">
        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-primary">Edit</a>

        @if ($activity->status === 'draft')
            <form method="POST" action="{{ route('activities.publish', $activity) }}">
                @csrf
                <button class="btn btn-success">Publish</button>
            </form>
        @endif

        @if ($activity->status === 'published')
            <form method="POST" action="{{ route('activities.complete', $activity) }}">
                @csrf
                <button class="btn btn-success">Selesaikan</button>
            </form>
        @endif

        <form method="POST" action="{{ route('activities.destroy', $activity) }}"
              onsubmit="return confirm('Yakin hapus kegiatan ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
        </form>
    </div>
</div>

@if ($activity->status === 'published')
<div class="card">
    <h2 style="font-size:1.1rem; margin-bottom:16px;">Daftar Peserta ({{ $activity->registrations->count() }})</h2>

    <form method="POST" action="{{ route('activities.registrations.store', $activity) }}" style="margin-bottom:20px;">
        @csrf
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <div style="flex:1; min-width:150px;">
                <input name="participant_name" placeholder="Nama peserta" value="{{ old('participant_name') }}">
                @error('participant_name') <p class="error-msg">{{ $message }}</p> @enderror
            </div>
            <div style="flex:1; min-width:150px;">
                <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
                @error('email') <p class="error-msg">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </div>
    </form>

    @if ($activity->registrations->count())
        <table>
            <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Waktu Daftar</th></tr></thead>
            <tbody>
                @foreach ($activity->registrations as $reg)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $reg->participant_name }}</td>
                        <td>{{ $reg->email }}</td>
                        <td>{{ $reg->registered_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color:#6b7280;">Belum ada peserta terdaftar.</p>
    @endif
</div>
@endif
@endsection
