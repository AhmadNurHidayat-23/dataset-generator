<?php
namespace App\Services;
class DatasetGenerator
{
    public const FIELDS = ['nama' => 'Nama', 'email' => 'Email', 'alamat' => 'Alamat', 'telepon' => 'Telepon sintetis',
        'transaksi_id' => 'ID transaksi', 'tanggal' => 'Tanggal transaksi', 'jumlah' => 'Jumlah (IDR)', 'status' => 'Status transaksi'];
    public function generate(int $count, array $fields): array
    {
        $rows = [];
        for ($i = 1; $i <= $count; $i++) {
            $id = str_pad((string) $i, 5, '0', STR_PAD_LEFT);
            $all = ['nama' => ['Nara', 'Aruna', 'Raka', 'Sena', 'Lumi'][($i - 1) % 5].' Contoh '.$id,
                'email' => "pengguna.$id@example.test", 'alamat' => "Jl. Simulasi No. $i, Kota Contoh",
                'telepon' => '+62-000-'.$id, 'transaksi_id' => 'DEMO-'.strtoupper(bin2hex(random_bytes(3))).'-'.$id,
                'tanggal' => now()->subDays(random_int(0, 365))->format('Y-m-d'), 'jumlah' => random_int(10, 5000) * 1000,
                'status' => ['berhasil', 'menunggu', 'dibatalkan'][random_int(0, 2)]];
            $rows[] = array_replace(array_fill_keys($fields, null), array_intersect_key($all, array_flip($fields)));
        }
        return $rows;
    }
    public static function csvCell(mixed $value): string
    {
        $text = (string) $value;
        return preg_match('/^[=+@\-\t\r]/', $text) ? "'".$text : $text;
    }
}
