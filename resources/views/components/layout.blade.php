<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dataset Generator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header><a class="brand" href="/">Dataset Generator<span class="text-green-800">.</span></a><span class="issue">UTILITAS DIGITAL / 02 — 2026</span></header>
<main>
    <p class="eyebrow">02 / Data contoh untuk ide berikutnya</p>
    {{ $slot }}
</main>
<footer><span>Dataset Generator / Dibuat untuk bekerja.</span><span>LOKAL · SEDERHANA · TERUKUR</span></footer>
</body>
</html>
