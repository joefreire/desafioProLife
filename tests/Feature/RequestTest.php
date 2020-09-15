<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Mail\FeedbackEmail;
use Illuminate\Support\Facades\Mail;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListaContatos()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function testInsereContato() {
        Mail::fake();
        Mail::assertNothingSent();
        $faker = Faker::create();
        $file  = UploadedFile::fake()->create('teste1.txt', 500, 'text/plain');
        $nome  = $faker->name;

        $response = $this->json('POST', '/api/contato', [
            'arquivo' => $file,
            'nome'    => $nome,
            'email'   => $faker->email,
            'telefone'=> '3199998888',
            'mensagem'=> $faker->paragraph,
        ]);

        Storage::disk('public')->assertExists($file->getClientOriginalName());
        $this->assertDatabaseHas('contatos', ['nome' => $nome]);
        $response->assertStatus(200)
            ->assertJson([
                'telefone' => '3199998888',
            ]);
        Mail::assertSent(FeedbackEmail::class, function ($mail) use ($nome) {
            return $mail->contato->nome === $nome;
        });
    }

    public function testInsereContatoArquivoGrande() {
        $faker = Faker::create();
        $file = UploadedFile::fake()->create('teste2.txt', 10000, 'text/plain');

        $response = $this->json('POST', '/api/contato', [
            'arquivo' => $file,
            'nome'    => $faker->name,
            'email'   => $faker->email,
            'telefone'=> '3199998888',
            'mensagem'=> $faker->paragraph,
        ]);

        Storage::disk('public')->assertMissing($file->getClientOriginalName());
        $response->assertStatus(422);
    }

    public function testInsereContatoArquivoFormatoInvalido() {
        $faker = Faker::create();
        Storage::fake('storage');
        $file = UploadedFile::fake()->create('teste3.jpg', 1000);

        $response = $this->json('POST', '/api/contato', [
            'arquivo' => $file,
            'nome'    => $faker->name,
            'email'   => $faker->email,
            'telefone'=> '3199998888',
            'mensagem'=> $faker->paragraph,
        ]);

        Storage::disk('public')->assertMissing($file->getClientOriginalName());
        $response->assertStatus(422);
    }

}
