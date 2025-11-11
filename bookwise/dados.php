<?php

$db = new PDO('mysql:host=mysql;dbname=bookwise', 'bookwise_user', 'secret123');

$query = $db->query('SELECT * FROM livros');

$livros = $query->fetchAll();

// dd($livros);

// $livros = [
//     [
//         'id' => 1,
//         'titulo' => 'Clean Code',
//         'autor' => 'Robert C. Martin',
//         'descricao' => 'Um guia prático sobre princípios, padrões e boas práticas para escrever código limpo, legível e sustentável em projetos de software.',
//         'imagem'    => 'https://covers.openlibrary.org/b/isbn/9780132350884-L.jpg'
//     ],
//     [
//         'id' => 2,
//         'titulo' => 'The Pragmatic Programmer',
//         'autor' => 'Andrew Hunt e David Thomas',
//         'descricao' => 'Clássico com conselhos práticos para evoluir como desenvolvedor, abordando carreira, design e boas práticas no dia a dia.',
//         'imagem'    => 'https://covers.openlibrary.org/b/isbn/9780201616224-L.jpg'
//     ],
//     [
//         'id' => 3,
//         'titulo' => 'Refactoring',
//         'autor' => 'Martin Fowler',
//         'descricao' => 'Mostra como melhorar o design de código existente com técnicas de refatoração e testes automatizados.',
//         'imagem'    => 'https://covers.openlibrary.org/b/isbn/9780201485677-L.jpg'
//     ],
//     [
//         'id' => 4,
//         'titulo' => 'Design Patterns',
//         'autor' => 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides',
//         'descricao' => 'Catálogo de padrões de projeto orientados a objetos para criar software flexível e reutilizável.',
//         'imagem'    => 'https://covers.openlibrary.org/b/isbn/9780201633610-L.jpg'
//     ],
//     [
//         'id' => 5,
//         'titulo' => 'You Don\'t Know JS Yet',
//         'autor' => 'Kyle Simpson',
//         'descricao' => 'Série que aprofunda os fundamentos de JavaScript, cobrindo escopo, closures, tipos e o motor da linguagem.',
//         'imagem'    => 'https://covers.openlibrary.org/b/isbn/9781098115456-L.jpg'
//     ],
//     [
//         'id' => 6,
//         'titulo' => 'Introduction to Algorithms',
//         'autor' => 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein',
//         'descricao' => 'Referência abrangente de algoritmos e estruturas de dados com análise de complexidade.',
//         'imagem'    => 'https://covers.openlibrary.org/b/isbn/9780262033848-L.jpg'
//     ],
//     [
//         'id' => 7,
//         'titulo' => 'Clean Architecture',
//         'autor' => 'Robert C. Martin',
//         'descricao' => 'Princípios de arquitetura de software para criar sistemas com baixo acoplamento e alta coesão, fáceis de evoluir.',
//         'imagem'    => 'https://covers.openlibrary.org/b/isbn/9780134494166-L.jpg'
//     ],
//     [
//         'id' => 8,
//         'titulo' => 'Code Complete',
//         'autor' => 'Steve McConnell',
//         'descricao' => 'Guia extenso sobre construção de software, cobrindo design, codificação, depuração e práticas de qualidade.',
//         'imagem'    => 'https://covers.openlibrary.org/b/isbn/9780735619678-L.jpg'
//     ]
// ];