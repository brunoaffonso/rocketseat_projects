CREATE TABLE usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(255) NOT NULL,
	email VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    descricao TEXT,
    ano_de_lancamento INT,
    nro_paginas INT,
    usuario_id INT,
    imagem VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Índices para melhorar performance de consultas
CREATE INDEX idx_livros_titulo ON livros(titulo);
CREATE INDEX idx_livros_autor ON livros(autor);
CREATE INDEX idx_livros_ano_lancamento ON livros(ano_de_lancamento);

INSERT INTO livros (titulo, autor, descricao, ano_de_lancamento, nro_paginas, imagem) VALUES
('Clean Code', 'Robert C. Martin', 'Um guia prático sobre princípios, padrões e boas práticas para escrever código limpo, legível e sustentável em projetos de software.', 2008, 464, 'https://covers.openlibrary.org/b/isbn/9780132350884-L.jpg'),
('The Pragmatic Programmer', 'Andrew Hunt e David Thomas', 'Clássico com conselhos práticos para evoluir como desenvolvedor, abordando carreira, design e boas práticas no dia a dia.', 1999, 352, 'https://covers.openlibrary.org/b/isbn/9780201616224-L.jpg'),
('Refactoring', 'Martin Fowler', 'Mostra como melhorar o design de código existente com técnicas de refatoração e testes automatizados.', 1999, 448, 'https://covers.openlibrary.org/b/isbn/9780201485677-L.jpg'),
('Design Patterns', 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides', 'Catálogo de padrões de projeto orientados a objetos para criar software flexível e reutilizável.', 1994, 395, 'https://covers.openlibrary.org/b/isbn/9780201633610-L.jpg'),
('You Don\'t Know JS Yet', 'Kyle Simpson', 'Série que aprofunda os fundamentos de JavaScript, cobrindo escopo, closures, tipos e o motor da linguagem.', 2020, 143, 'https://covers.openlibrary.org/b/isbn/9781098115456-L.jpg'),
('Introduction to Algorithms', 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein', 'Referência abrangente de algoritmos e estruturas de dados com análise de complexidade.', 2009, 1312, 'https://covers.openlibrary.org/b/isbn/9780262033848-L.jpg'),
('Clean Architecture', 'Robert C. Martin', 'Princípios de arquitetura de software para criar sistemas com baixo acoplamento e alta coesão, fáceis de evoluir.', 2017, 432, 'https://covers.openlibrary.org/b/isbn/9780134494166-L.jpg'),
('Code Complete', 'Steve McConnell', 'Guia extenso sobre construção de software, cobrindo design, codificação, depuração e práticas de qualidade.', 2004, 960, 'https://covers.openlibrary.org/b/isbn/9780735619678-L.jpg');

INSERT INTO usuarios (nome, email) VALUES
('Bruno Silva', 'bruno.silva@email.com'),
('Maria Santos', 'maria.santos@email.com'),
('João Oliveira', 'joao.oliveira@email.com'),
('Ana Costa', 'ana.costa@email.com'),
('Carlos Pereira', 'carlos.pereira@email.com'),
('Juliana Souza', 'juliana.souza@email.com'),
('Pedro Almeida', 'pedro.almeida@email.com'),
('Fernanda Lima', 'fernanda.lima@email.com');
