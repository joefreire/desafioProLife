<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\InserirContatoRequest;
use App\Contato;
use App\Mail\FeedbackEmail;


class ContatoController extends Controller
{
    public function inserir(InserirContatoRequest $request) {
        $contato = new Contato();

        try {
            $url_arquivo  = $contato->saveFile($request->arquivo);

            $contato->nome        = $request->nome;
            $contato->email       = $request->email;
            $contato->telefone    = $request->telefone;
            $contato->mensagem    = $request->mensagem;
            $contato->url_arquivo = $url_arquivo;
            $contato->ip_origem   = $request->ip();
            $contato->save();

            Mail::to($contato->email)->send(new FeedbackEmail($contato)); 


        } catch(\Exception $e) {
            abort(422, $e->getMessage());
        }
    
        return response($contato);
    }

    public function recuperar() {
        $contatos = Contato::all();
        return response($contatos);
    }

}
