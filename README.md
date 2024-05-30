
# Gerenciamento de Usuários

Este projeto é um sistema simples de CRUD (Create, Read, Update, Delete) WEB e API rest full para gerenciamento de usuários. O sistema permite criar novos usuários, visualizar a lista de usuários, atualizar informações existentes e deletar usuários.


## Stack utilizada

**Back-end:** Laravel

**Front-end:** Laravel/Blade com bootstrap

**Banco de dados:** PostgreSQL




## Rodando localmente

Clone o projeto

```bash
  git clone https://github.com/matheusroomao/user-manager.git
```

Entre no diretório do projeto

```bash
  cd user-manager
```

Instale as dependências

```bash
  composer install
```

```bash
  npm install
```

Configure .env com suas credenciais de banco de dados

```bash
  cp .env.example .env
```

Rode a migrate

```bash
  php artisan migrate
```

Inicie o servidor

```bash
  php artisan serve
```
```bash
  npm run dev
```

## Documentação WEB

#### Acesse em seu navegador

```http
  http://localhost:8000/
```

## Documentação API

#### Retorna todos os usuários

```http
  GET /api/users
```
#### Retorna um usuário

```http
  GET /api/users/{id}
```


#### Criar usuário

```http
  POST /api/users
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `name`      | `string` | **Obrigatório**. Nome do usuário |
| `email`     | `email` | **Obrigatório**. E-mail do usuário |
| `password`  | `password` | **Obrigatório**. Senha do usuário |
| `password_confirmation`  | `password` | **Obrigatório**. Confirmação de senha do usuário |


#### Atualizar um usuário

```http
  PUT /api/users/{id}
```
Não é necessário enviar todos os campos, apenas o que deseja atualizar.

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `name`      | `string` |  Nome do usuário |
| `email`     | `email` | E-mail do usuário |
| `password`  | `password` | Senha do usuário |
| `password_confirmation`  | `password` | **Obrigatório quando for atualizar a senha**. Confirmação de senha do usuário |

#### Apagar um usuário

```http
  DELETE /api/users/{id}
```
## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  php artisan test
```

