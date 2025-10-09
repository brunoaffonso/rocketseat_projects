# Book Wise

Pequeno protótipo de UI usando Tailwind via CDN.

## Documentação

- [Estrutura do Projeto](docs/estrutura-do-projeto.md)

## Rodar localmente

```bash
php -S localhost:8000 -t .
```

Acesse:

- http://localhost:8000/
- http://localhost:8000/login.php
- http://localhost:8000/meus-livros.php

## Rodar com Docker Compose

Pré-requisitos:

- Docker e Docker Compose instalados

1) Variáveis de ambiente

- Este repositório já inclui um arquivo `.env` com valores padrão para o MySQL. Caso precise alterar, edite-o ou crie um com as variáveis abaixo:

```
MYSQL_ROOT_PASSWORD=rootpass
MYSQL_DATABASE=bookwise
MYSQL_USER=bookwise_user
MYSQL_PASSWORD=secret123
```

2) Subir os serviços

```bash
docker compose up --build -d
```

- A aplicação ficará disponível em: http://localhost:8888/
- O MySQL ficará disponível em: localhost:3306

Dentro dos containers, use `mysql` como hostname do banco (nome do serviço no compose).

3) Inicialização do banco (opcional)

- Coloque arquivos `.sql` em `docker/mysql-init/` para serem executados automaticamente na primeira inicialização do MySQL.

4) Comandos úteis

- Ver logs: `docker compose logs -f`
- Parar: `docker compose stop`
- Subir novamente: `docker compose up -d`
- Remover tudo (incluindo volume do banco): `docker compose down -v`

## Notas

- Tailwind carregado pelo CDN `@tailwindcss/browser@4`.
- HTML sem backend; os formulários são mock.
- Estrutura e estilos consistentes entre páginas.
