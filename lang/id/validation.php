<?php
return [
    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'array' => ':attribute harus berupa daftar.',
    'json' => ':attribute harus berupa JSON yang valid.',
    'in' => ':attribute tidak termasuk pilihan yang tersedia.',
    'distinct' => ':attribute tidak boleh berulang.',
    'unique' => ':attribute sudah digunakan untuk metode yang sama.',
    'regex' => 'Format :attribute tidak valid.',
    'url' => ':attribute harus berupa URL yang valid.',
    'max' => [
        'numeric' => ':attribute tidak boleh lebih dari :max.',
        'string' => ':attribute tidak boleh lebih dari :max karakter.',
        'array' => ':attribute tidak boleh lebih dari :max pilihan.',
    ],
    'min' => [
        'numeric' => ':attribute minimal :min.',
        'string' => ':attribute minimal :min karakter.',
        'array' => ':attribute minimal :min pilihan.',
    ],
    'attributes' => [
        'name' => 'Nama endpoint', 'method' => 'Metode HTTP', 'path' => 'Path endpoint',
        'body' => 'Respons JSON', 'status' => 'Status HTTP', 'headers_json' => 'Custom headers',
        'count' => 'Jumlah baris', 'fields' => 'Kolom data', 'fields.*' => 'Pilihan kolom',
        'url' => 'URL halaman',
    ],
];
