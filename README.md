# Teste PROLIFE

## Informações acerca da aplicação
- Banco utilizado: SQLite 
- Servidor SMTP: [Mailtrap](https://mailtrap.io)
- Framework CSS: Bootstrap
- Frontend: Vue (latest)
- Backend: Laravel (6.0)

## Instalação
```bash
git clone https://github.com/joefreire/desafioProLife.git
cd teste-prossigo
cp .env.example .env
npm install
npm run dev
composer install
php artisan key:generate
php artisan storage:link
touch database/database.sqlite
php artisan migrate
php artisan serve

```

## ENV
configurar dados do SMTP no env para envio do email

## Testes
Os testes de Storage podem escrever no diretório `storage/app/public`.  
Para limpar esse diretório antes de executar os testes, execute o comando:
```bash
php artisan clean-storage
```

Para executar os testes:
```bash
phpunit
```
