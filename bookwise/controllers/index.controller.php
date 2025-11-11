<?php

$livros = (new DB)->livros($_REQUEST['buscar'] ?? null);

view('index', [
    'livros' => $livros,
]);