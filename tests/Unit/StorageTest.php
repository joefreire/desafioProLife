<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorageTest extends TestCase
{
    /**
     * Testa se eh possivel salvar arquivo fake em storage fake.
     *
     * @return void
     */
    public function testFakePutFile() {
        Storage::fake('storage');
        $file = UploadedFile::fake()->create('teste.txt', 500, 'text/plain');
        Storage::disk('storage')->put($file->getClientOriginalName(), file_get_contents($file->getRealPath()));

        Storage::disk('storage')->assertExists($file->getClientOriginalName());
        Storage::disk('storage')->assertMissing('missing.jpg');
        Storage::fake('storage');
    }

    /**
     * Testa se eh possivel salvar arquivo fake no storage public.
     *
     * @return void
     */
    public function testRealPutFile() {
        $file = UploadedFile::fake()->create('teste_real.txt', 500, 'text/plain');
        Storage::disk('public')->put($file->getClientOriginalName(), file_get_contents($file->getRealPath()));
        Storage::disk('public')->assertExists($file->getClientOriginalName());
    }
}
