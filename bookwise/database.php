<?php


class DB
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=mysql;dbname=bookwise', 'bookwise_user', 'secret123');
    }

    /**
     * Retorna todos os livros do banco de dados
     * 
     * @return array[Livro]
     */
    public function livros($buscar)
    {
        $prepare = $this->db->prepare('SELECT * FROM livros WHERE titulo LIKE :buscar OR descricao LIKE :buscar OR autor LIKE :buscar');
        $prepare->bindValue(':buscar', '%' . $buscar . '%');
        $prepare->execute();
        $items = $prepare->fetchAll();

        return array_map(fn($item) => Livro::make($item), $items);
    }

    public function livro($id)
    {
        $sql = 'SELECT * FROM livros';
        $sql .= " WHERE id = " . $id;

        $query = $this->db->query($sql);
        $items = $query->fetchAll();

        return array_map(fn($item) => Livro::make($item), $items)[0];
    }
}