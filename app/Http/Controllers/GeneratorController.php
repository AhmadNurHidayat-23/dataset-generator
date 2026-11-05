<?php
namespace App\Http\Controllers;
use App\Services\DatasetGenerator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class GeneratorController extends Controller
{
    public function index(Request $request)
    {
        return view('generator', ['available' => DatasetGenerator::FIELDS, 'rows' => $request->session()->get('dataset', []),
            'settings' => $request->session()->get('settings', ['count' => 100, 'fields' => ['nama', 'email', 'alamat', 'telepon']])]);
    }
    public function generate(Request $request, DatasetGenerator $generator)
    {
        $settings = $request->validate(['count' => 'required|integer|min:1|max:5000', 'fields' => 'required|array|min:1|max:8',
            'fields.*' => ['required', 'string', 'distinct', Rule::in(array_keys(DatasetGenerator::FIELDS))]]);
        $request->session()->put(['dataset' => $generator->generate($settings['count'], $settings['fields']), 'settings' => $settings]);
        return redirect('/')->with('notice', $settings['count'].' baris data sintetis siap digunakan.');
    }
    public function reset(Request $request)
    {
        $request->session()->forget(['dataset', 'settings']); return redirect('/');
    }
    public function export(Request $request, string $format)
    {
        abort_unless(in_array($format, ['csv', 'json']), 404);
        $rows = $request->session()->get('dataset', []);
        abort_if(empty($rows), 422, 'Buat dataset terlebih dahulu.');
        if ($format === 'json') return response()->streamDownload(function () use ($rows) {
            echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }, 'dataset-sintetis.json', ['Content-Type' => 'application/json']);
        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, array_keys($rows[0]), ',', '"', '');
            foreach ($rows as $row) fputcsv($out, array_map(DatasetGenerator::csvCell(...), $row), ',', '"', '');
            fclose($out);
        }, 'dataset-sintetis.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
