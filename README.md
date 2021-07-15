# jornada-microservicos

###Executar o serviço de produtos
docker-compose up -d

### Conectar no container
docker-compose exec productapp bash

## Compilar o projeto

- Baixar o Laravel Nova 3.x e colocar dentro da pasta nova
- Conectar no container
- Baixar dependencia: `composer update`
- Instalar o nova: `php artisan nova:install`
- Recriar o banco: `php artisan migrate:refresh`
- Criar um usuário admin:
    - Entrar no modo shell: `php artisan tinker`
    - Inserir um user admin: `App\Models\User::create(['name'=>'Admin','email'=>'admin@teste.com','password'=>bcrypt('admin')]);`

## Alguns comandos

### Criar um model Laravel
`php artisan make:model Product`

### Criar um resource gerenciado pelo Laravel Nova
`php artisan nova:resource Product`

