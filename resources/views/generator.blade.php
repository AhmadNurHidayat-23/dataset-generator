<x-layout>
<h1>Data siap pakai.<br>Ide siap diuji.</h1>
<p class="intro">Isi prototipe, uji tabel, atau simulasikan transaksi. Tentukan kolom Anda, lalu hasilkan dataset sintetis dalam hitungan detik.</p>
@if(session('notice'))<p class="note" role="status">{{ session('notice') }}</p>@endif
@if($errors->any())<div class="error" role="alert">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
<div class="grid">
<section class="panel"><div class="section-head"><h2>Susun dataset</h2><span class="num">01 / PILIHAN DATA</span></div>
<form method="post" action="/generate">@csrf
<div class="field"><label for="count">Jumlah baris</label><input id="count" name="count" type="number" min="1" max="5000" required value="{{ old('count', $settings['count']) }}"><small>1–5.000 baris setiap pembuatan.</small></div>
<label>Kolom yang dihasilkan</label><div class="checks">
@foreach($available as $key => $label)<label><input type="checkbox" name="fields[]" value="{{ $key }}" @checked(in_array($key, old('fields', $settings['fields'])))>{{ $label }}</label>@endforeach
</div><button>Buat dataset →</button></form>
<form action="/reset" method="post" class="stack">@csrf<button class="secondary">Reset generator</button></form>
<p class="note">Seluruh identitas adalah contoh buatan. Email memakai domain .test dan nomor telepon memakai pola nonaktif +62-000. Nilai transaksi dalam Rupiah.</p>
</section>
<section class="panel"><div class="section-head"><h2>Hasil Anda</h2><span class="tag">{{ count($rows) }} BARIS</span></div>
@if($rows)
<div class="row"><a class="button" href="/export/csv">Unduh CSV ↓</a><a class="button secondary" href="/export/json">Unduh JSON ↓</a><button class="secondary" data-copy="#full-json">Salin JSON</button></div>
<p class="muted stack">Preview 20 baris pertama. Ekspor dan salin memuat semua {{ count($rows) }} baris yang sama.</p>
<div class="table-wrap"><table><thead><tr>@foreach(array_keys($rows[0]) as $key)<th>{{ $key }}</th>@endforeach</tr></thead><tbody>
@foreach(array_slice($rows, 0, 20) as $row)<tr>@foreach($row as $value)<td>{{ $value }}</td>@endforeach</tr>@endforeach
</tbody></table></div><pre hidden id="full-json">{{ json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@else<p class="empty">Dataset Anda akan muncul di sini.<br>Pilih kolom dan buat data pertama.</p><pre>nama          email
Nara Contoh   pengguna.00001@example.test
Aruna Contoh  pengguna.00002@example.test</pre><p class="muted">Ilustrasi format. Hasil sebenarnya dibuat saat Anda menekan tombol.</p>@endif
</section></div>
</x-layout>
