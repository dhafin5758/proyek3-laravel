@extends('layouts.app')

@section('title', $activity->title)

@section('content')
<div style="margin-bottom:16px;">
    <a href="{{ route('activities.index') }}" style="color:#1e3a5f; text-decoration:none;">← Kembali ke Daftar</a>
</div>

<div class="card">
    @php
        $badgeClass = match($activity->status) {
            'Planned' => 'badge-planned',
            'Ongoing' => 'badge-ongoing',
            'Done'    => 'badge-done',
            default   => '',
        };
    @endphp
    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
        <h1 style="font-size:1.5rem;">{{ $activity->title }}</h1>
        <span class="badge {{ $badgeClass }}" style="font-size:0.9rem;">{{ $activity->status }}</span>
    </div>

    <table style="width:100%; border-collapse:collapse; font-size:0.95rem;">
        <tr>
            <td style="padding:8px 0; color:#6b7280; width:160px; font-weight:600;">Tanggal</td>
            <td>{{ $activity->activity_date->format('d M Y') }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; color:#6b7280; font-weight:600;">Kategori</td>
            <td>{{ $activity->category }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; color:#6b7280; font-weight:600;">Deskripsi</td>
            <td>{{ $activity->description ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; color:#6b7280; font-weight:600;">Dibuat</td>
            <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0; color:#6b7280; font-weight:600;">Diperbarui</td>
            <td>{{ $activity->updated_at->format('d M Y H:i') }}</td>
        </tr>
    </table>

    <div class="actions" style="margin-top:20px; padding-top:16px; border-top:1px solid #e5e7eb;">
        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-primary">Edit</a>

        <form method="POST" action="{{ route('activities.destroy', $activity) }}"
              onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>

        <a href="{{ route('activities.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>
@endsection
