# Laravel Livewire Filter

Este projeto é uma aplicação Laravel 12 para filtro com Livewire 3 de listagem de produtos.

---

### Instalação

#### Clone o repositório

```bash
git clone git@github.com:denisgusto/laravel-livewire-filter.git
cd laravel-livewire-filter
```

#### Copie o arquivo .env.example

```bash
cp .env.example .env
```

#### Configurações do .env
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_livewire_filter
DB_USERNAME=root
DB_PASSWORD=root
```

### Execute os containers docker
```bash
docker compose build

docker compose up -d
```

### Execute os comandos de configuração
```bash
composer install && npm install && npm run build

php artisan key:generate && php artisan migrate:fresh --seed
```

### Execute os testes
```bash
php artisan test
```

### Acessando a aplicação
```bash
GET | http://localhost/  # Página inicial
GET | http://localhost/products  # Listagem de produtos
```