<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Services\DatasetGenerator;
class GeneratorTest extends TestCase
{
    public function test_generate_preview_export_and_reset(): void
    {
        $fields = array_keys(DatasetGenerator::FIELDS);
        $this->post('/generate', ['count' => 25, 'fields' => $fields])->assertRedirect('/');
        $rows = session('dataset');
        $this->assertCount(25, $rows); $this->assertSame($fields, array_keys($rows[0]));
        $this->assertStringEndsWith('@example.test', $rows[0]['email']);
        $this->get('/')->assertOk()->assertSee('25 BARIS')->assertSee('Preview 20');
        $json = $this->get('/export/json')->assertOk()->streamedContent();
        $this->assertEquals($rows, json_decode($json, true));
        $csv = $this->get('/export/csv')->assertOk()->streamedContent();
        $this->assertStringContainsString('nama,email,alamat,telepon', $csv);
        $this->assertStringContainsString("'+62-000-00001", $csv);
        $this->post('/reset')->assertRedirect('/'); $this->assertNull(session('dataset'));
        $this->get('/export/json')->assertStatus(422);
    }
    public function test_invalid_fields_and_limits_are_rejected(): void
    {
        foreach ([0, 5001] as $count) $this->post('/generate', ['count' => $count, 'fields' => ['nama']])->assertSessionHasErrors('count');
        $this->post('/generate', ['count' => 5, 'fields' => ['password']])->assertSessionHasErrors('fields.0');
        $this->post('/generate', ['count' => 5])->assertSessionHasErrors('fields');
        $this->post('/generate', ['count' => 3, 'fields' => ['email']])->assertRedirect();
        $this->assertSame(['email'], array_keys(session('dataset')[0]));
    }
}
