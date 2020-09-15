<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\ContatoController;
use App\Http\Requests\InserirContatoRequest;

class RequestValidationTest extends TestCase
{
    private $request;

    /**
     * Verifica se a acao inserir contato possui a request correta associada a ela
     *
     * @return void
     */
    public function testInsereContatoFormRequest() {
        $this->assertActionUsesFormRequest(ContatoController::class, 'inserir', InserirContatoRequest::class);
    }

    protected function setUp(): void {
        parent::setUp();
        $this->request = new InserirContatoRequest();
    }

    /**
     * @depends testInsereContatoFormRequest
     */
    public function testRules()
    {
        $this->assertEquals([
                'nome'     => 'required|max:255|string',
                'email'    => 'required|max:100|email',
                'telefone' => 'required|max:11|string',
                'mensagem' => 'required|max:1000|string',
                'arquivo'  => 'required|file|mimes:pdf,doc,docx,odt,txt|max:500',
            ], $this->request->rules()
        );
    }

    /**
     * @depends testInsereContatoFormRequest
     */
    public function testAuthorize()
    {
        $this->assertTrue($this->request->authorize());
    }
}
