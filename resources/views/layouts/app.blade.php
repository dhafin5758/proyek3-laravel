<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Activity Manager')</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: #f5f5f5; color: #1a1a1a; line-height: 1.6; }
        .container { max-width: 900px; margin: 0 auto; padding: 0 16px; }
        nav { background: #000; color: #fff; padding: 12px 0; margin-bottom: 24px; }
        nav .container { display: flex; align-items: center; gap: 20px; }
        nav a { color: #fff; text-decoration: none; font-weight: 600; font-size: 1.1rem; }
        nav .nav-links { display: flex; gap: 16px; margin-left: auto; }
        nav .nav-links a { font-weight: 400; font-size: 0.95rem; opacity: 0.85; }
        nav .nav-links a:hover { opacity: 1; }
        .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 0.95rem; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .card { background: #fff; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,.08); padding: 20px 24px; margin-bottom: 16px; }
        .badge { display: inline-block; padding: 2px 10px; border-radius: 12px; font-size: 0.8rem; font-weight: 600; }
        .badge-planned { background: #dbeafe; color: #1d4ed8; }
        .badge-ongoing { background: #fef3c7; color: #92400e; }
        .badge-done { background: #d1fae5; color: #065f46; }
        .btn { display: inline-block; padding: 8px 18px; border-radius: 6px; font-size: 0.9rem; font-weight: 600; text-decoration: none; cursor: pointer; border: none; }
        .btn-primary { background: #1e3a5f; color: #fff; }
        .btn-secondary { background: #e5e7eb; color: #1a1a1a; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn:hover { opacity: 0.9; }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 4px; color: #374151; }
        input, textarea, select { width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.95rem; font-family: inherit; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #1e3a5f; box-shadow: 0 0 0 2px rgba(30,58,95,.15); }
        .error-msg { color: #dc2626; font-size: 0.85rem; margin-top: 4px; }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; }
        footer { text-align: center; padding: 24px 0; color: #6b7280; font-size: 0.85rem; margin-top: 40px; }
    </style>
</head>
<body>
<nav>
    <div class="container">
        <a href="{{ route('activities.index') }}">Activity Manager</a>
        <div class="nav-links">
            <a href="{{ route('activities.index') }}">Daftar</a>
            <a href="{{ route('activities.create') }}">+ Tambah</a>
        </div>
    </div>
</nav>

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->has('status'))
        <div class="alert alert-error">{{ $errors->first('status') }}</div>
    @endif

    @yield('content')
</div>

<footer>Activity Manager v1 — Modul 3 Laravel Basic</footer>
</body>
</html>
