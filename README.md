# Documentação

### Pré-requisitos:

-   [PHP 8.1](https://www.php.net/)
-   [Composer](https://getcomposer.org/)
-   [Node.js](https://nodejs.org/en/)
-   [NPM](https://www.npmjs.com/)

### Configuração:

1. Instale as dependências do PHP

```bash
    composer install
    npm install
```

2. Copie o arquivo .env.example para .env

```bash
    cp .env.example .env
```

3. Gere uma nova chave para a aplicação

```bash
    php artisan key:generate
```

4. Crie o banco de dados

```bash
    php artisan migrate --seed
```

5. Inicie o servidor

```bash
    php artisan storage:link
```

6. Inicie o servidor

```bash
    php artisan serve
```
