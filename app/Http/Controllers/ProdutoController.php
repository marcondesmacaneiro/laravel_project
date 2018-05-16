<?php

namespace estoque\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;

class ProdutoController
{
    public function lista() {
        if (view()->exists("produtos-listagem")) {
            $produtos = DB::select("select * from produtos");
            return view("produtos-listagem")->withProdutos($produtos);
        } else {
            //criar uma view para erro 404 ou algo parecido.
            return "Página não localizada!";
        }
    }

    public function mostra() {
        $id = Request::route('id', '0');
        $resposta = DB::select("select * from produtos where id = ?",[$id]);
        if (empty($resposta)) {
            return "<h1>Este produto não existe</h1>";
        } else {
            return view("produtos-detalhes")->with("p",$resposta[0]);
        }
    }
}
