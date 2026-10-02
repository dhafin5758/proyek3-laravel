@extends('layouts.app')
@section('title', 'Trash')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h1 style="font-size:1.5rem;">Trash</h1>
    <a href="{{ route('activities.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

@forelse ($activities as $activity)
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <strong>[{{ $activity->code }}] {{ $activity->title }}</strong>
                <p style="color:#6b7280; font-size:0.85rem;">Dihapus: {{ $activity->deleted_at->format('d M Y H:i') }}</p>
            </div>
            <form method="POST" action="{{ route('activities.restore', $activity->id) }}">
                @csrf
                <button class="btn btn-success btn-sm">Pulihkan</button>
            </form>
        </div>
    </div>
@empty
    <div class="card" style="text-align:center; color:#6b7280;">Trash kosong.</div>
@endforelse

<div>{{ $activities->links() }}</div>
@endsection
