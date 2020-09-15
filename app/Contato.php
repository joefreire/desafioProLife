<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contato extends Model
{
    //
    protected $fillable = ['url_arquivo', 'ip_origem', 'created_at', 'nome', 'email', 'telefone', 'mensagem'];

    /**
     * Tenta salvar arquivo
     * @param $arquivo: FileUpload
     * @return $url_arquivo
     * @throws Exception: "Nao foi possivel salvar o arquivo" 
     */
    public function saveFile($arquivo) {
        $nome_arquivo = $arquivo->getClientOriginalName();
        $cont_arquivo = file_get_contents($arquivo->getRealPath());
        $b_arq_salvo  = Storage::disk('public')->put($nome_arquivo, $cont_arquivo);
        if(!$b_arq_salvo) throw new Exception("Nao foi possivel salvar o arquivo", 500);
        return asset("storage/$nome_arquivo");
    }
}
