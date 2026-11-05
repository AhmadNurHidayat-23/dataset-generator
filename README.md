# Dataset Generator

Generator data dummy sintetis untuk pengujian aplikasi.

## Fitur

- Nama, email, alamat, telepon sintetis, dan data transaksi.
- Pilih kolom dan 1–5.000 baris.
- Preview, salin JSON, ekspor CSV/JSON, serta reset.

## Teknologi

Laravel 13, Blade, Tailwind CSS 4, PHP 8.3+, Node.js 22.

## Menjalankan

Simpan di `C:\laragon\www\dataset-generator`. Jalankan:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate
npm ci
npm run build
```

Di Laragon pilih **Start All**, lalu **Reload** untuk virtual host `dataset-generator.test` dengan document root `public`. Panel dibatasi ke komputer lokal. Pengujian: `php artisan test`.

Data disimpan dalam sesi lokal. Identitas memakai label Contoh, domain .test dan nomor nonaktif; tidak berasal dari data pribadi. CSV melindungi sel yang dapat dibaca sebagai formula.
