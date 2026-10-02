{{-- Shared form partial for create & edit --}}
<div class="form-group">
    <label for="category_id">Kategori</label>
    <select id="category_id" name="category_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $activity->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    @error('category_id') <p class="error-msg">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="code">Kode Kegiatan</label>
    <input id="code" name="code" value="{{ old('code', $activity->code ?? '') }}" maxlength="30">
    @error('code') <p class="error-msg">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="title">Judul</label>
    <input id="title" name="title" value="{{ old('title', $activity->title ?? '') }}" maxlength="150">
    @error('title') <p class="error-msg">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea id="description" name="description" rows="3">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description') <p class="error-msg">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="location">Lokasi</label>
    <input id="location" name="location" value="{{ old('location', $activity->location ?? '') }}">
    @error('location') <p class="error-msg">{{ $message }}</p> @enderror
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
    <div class="form-group">
        <label for="start_at">Tanggal Mulai</label>
        <input id="start_at" name="start_at" type="datetime-local"
               value="{{ old('start_at', isset($activity->start_at) ? $activity->start_at->format('Y-m-d\TH:i') : '') }}">
        @error('start_at') <p class="error-msg">{{ $message }}</p> @enderror
    </div>
    <div class="form-group">
        <label for="end_at">Tanggal Selesai</label>
        <input id="end_at" name="end_at" type="datetime-local"
               value="{{ old('end_at', isset($activity->end_at) ? $activity->end_at->format('Y-m-d\TH:i') : '') }}">
        @error('end_at') <p class="error-msg">{{ $message }}</p> @enderror
    </div>
</div>

<div class="form-group">
    <label for="capacity">Kapasitas</label>
    <input id="capacity" name="capacity" type="number" min="1" max="500"
           value="{{ old('capacity', $activity->capacity ?? '') }}">
    @error('capacity') <p class="error-msg">{{ $message }}</p> @enderror
</div>
