# Activity Manager 

Aplikasi manajemen kegiatan sederhana berbasis Laravel 13. 
## Versi

| Tools       | Versi         |
|-------------|---------------|
| PHP         | 8.3.35        |
| Composer    | 2.10.3        |
| Laravel     | 13.33.0       |
| Database    | SQLite        |

## Setup & Menjalankan Proyek

### 1. Clone dan Install Dependensi

```bash
git clone <URL_REPOSITORY>
cd activity-manager
composer install
```

### 2. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Pastikan `.env` menggunakan konfigurasi SQLite:

```
DB_CONNECTION=sqlite
```

### 3. Buat File Database SQLite

```bash
# Windows PowerShell
New-Item -ItemType File database/database.sqlite
```

### 4. Jalankan Migration dan Seeder

```bash
php artisan migrate
php artisan db:seed --class=ActivitySeeder
```

### 5. Jalankan Server Development

```bash
php artisan serve
```

Aplikasi dapat diakses di: **http://localhost:8000**

---

## Route Utama

| Method    | URI                        | Nama Route            | Fungsi             |
|-----------|----------------------------|-----------------------|--------------------|
| GET       | /activities                | activities.index      | Daftar kegiatan    |
| GET       | /activities/create         | activities.create     | Form tambah        |
| POST      | /activities                | activities.store      | Simpan baru        |
| GET       | /activities/{id}           | activities.show       | Detail kegiatan    |
| GET       | /activities/{id}/edit      | activities.edit       | Form edit          |
| PUT/PATCH | /activities/{id}           | activities.update     | Simpan perubahan   |
| DELETE    | /activities/{id}           | activities.destroy    | Hapus              |








---

## 

- **Nama**: Muhammad Dhafin Ramadhan
- **NIM**: 251511019
- **Kelas**: D3-2A
- **Mata Kuliah**: Proyek 3 Pengembangan Perangkat Lunak Berbasis Web
