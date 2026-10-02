@extends('layouts.app')
@section('title', 'Kategori')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h1 style="font-size:1.5rem;">Kategori</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

<div class="card">
    <table>
        <thead><tr><th>Nama</th><th>Slug</th><th>Jumlah Kegiatan</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse ($categories as $cat)
                <tr>
                    <td>{{ $cat->name }}</td>
                    <td style="color:#6b7280;">{{ $cat->slug }}</td>
                    <td>{{ $cat->activities_count }}</td>
                    <td>
                        <form method="POST" action="{{ route('categories.destroy', $cat) }}"
                              onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align:center; color:#6b7280;">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
