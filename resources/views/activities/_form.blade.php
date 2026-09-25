{{-- Partial form digunakan bersama antara create dan edit --}}

<div class="form-group">
    <label for="title">Judul Kegiatan <span style="color:red">*</span></label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $activity->title ?? '') }}"
        placeholder="Minimal 5, maksimal 100 karakter"
        maxlength="100"
    >
    @error('title')
        <p class="error-msg">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea
        id="description"
        name="description"
        rows="4"
        placeholder="Deskripsi singkat kegiatan (opsional)"
        maxlength="1000"
    >{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <p class="error-msg">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="activity_date">Tanggal Kegiatan <span style="color:red">*</span></label>
    <input
        type="date"
        id="activity_date"
        name="activity_date"
        value="{{ old('activity_date', isset($activity->activity_date) ? $activity->activity_date->format('Y-m-d') : '') }}"
    >
    @error('activity_date')
        <p class="error-msg">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="category">Kategori <span style="color:red">*</span></label>
    <input
        type="text"
        id="category"
        name="category"
        value="{{ old('category', $activity->category ?? '') }}"
        placeholder="Contoh: Workshop, Seminar, Praktikum"
        maxlength="50"
    >
    @error('category')
        <p class="error-msg">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="status">Status <span style="color:red">*</span></label>
    <select id="status" name="status">
        @foreach (['Planned', 'Ongoing', 'Done'] as $statusOption)
            <option
                value="{{ $statusOption }}"
                @selected(old('status', $activity->status ?? 'Planned') === $statusOption)
            >
                {{ $statusOption }}
            </option>
        @endforeach
    </select>
    @error('status')
        <p class="error-msg">{{ $message }}</p>
    @enderror
</div>
