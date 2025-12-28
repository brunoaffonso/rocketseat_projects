# Bio Links

Plataforma de agregação de links (estilo Linktree) construída com Laravel. Este projeto permite que usuários criem um perfil público e gerenciem uma lista de links de forma organizada e estilizada.

## 🚀 Funcionalidades

- **Autenticação**: Registro e login de usuários.
- **Gerenciamento de Links**: Criar, editar, excluir e reordenar links.
- **Perfil Público**: Página personalizada (ex: `/seu-usuario`) exibindo todos os links ativos.
- **Dashboard**: Painel administrativo para controle total dos links e do perfil.

## 🛠️ Tecnologias Utilizadas

- **Framework**: [Laravel 12](https://laravel.com)
- **Frontend**: Blade Templates & Vanilla CSS
- **Banco de Dados**: SQLite (configurado por padrão)

## 🔧 Instalação e Configuração

Siga os passos abaixo para rodar o projeto localmente:

1. **Clone o repositório** (se ainda não o fez):
   ```bash
   cd biolinks
   ```

2. **Setup do projeto**:
   Utilize o comando de setup automatizado (ele instala dependências, cria o banco e gera as chaves):
   ```bash
   composer run setup
   ```

3. **Inicie o servidor de desenvolvimento**:
   ```bash
   composer run dev
   ```
   *Ou apenas o servidor PHP:*
   ```bash
   php artisan serve
   ```

4. **Acesse no navegador**:
   Acesse [http://localhost:8000](http://localhost:8000)

## 📄 Licença

Este projeto é open-source e licenciado sob a [MIT license](https://opensource.org/licenses/MIT).

