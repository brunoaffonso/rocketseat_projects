<?php

class Livro
{
    public $id;
    public $titulo;
    public $autor;
    public $descricao;
    public $ano_de_lancamento;
    public $nro_paginas;
    public $usuario_id;
    public $imagem;

    public static function make($item): Livro
    {
        $livro = new self();
        $livro->id = $item['id'];
        $livro->titulo = $item['titulo'];
        $livro->autor = $item['autor'];
        $livro->descricao = $item['descricao'];
        $livro->ano_de_lancamento = $item['ano_de_lancamento'];
        $livro->nro_paginas = $item['nro_paginas'];
        $livro->usuario_id = $item['usuario_id'];
        $livro->imagem = $item['imagem'];

        return $livro;
    }
}