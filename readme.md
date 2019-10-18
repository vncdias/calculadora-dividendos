# Calculadora de Dividendos
O projeto visa demonstrar quais seriam os dividendos retornados em investimentos feito em um período, com base nos dados registrados relacionados às ações

## Como configurar
Este projeto utiliza Laravel 5 e depende de PHP 7.1 ou superior, um servidor web de sua escolha e banco de dados MySQL/MariaDB. Maiores informações sobre dependências podem ser vistas na [Documentação do Laravel](https://laravel.com/docs/5.8#installation). Para ambientes de desenvolvimento, recomenda-se utilizar o projeto [Laradock](https://laradock.io/) caso tenha habilidades com Docker ou utilizar do comando `php artisan serve`.

Tendo suprido as dependências PHP necessárias e configurado seu web server, os passos são:
- Copie o arquivo `.env.example` em `.env` e configure as variáveis de ambiente relacionadas a banco de dados e domínio da aplicação se necessário;
- Execute `php artisan key:generate` para gerar uma chave de aplicação;
- Execute `php artisan migrate` para criar as tabelas no banco de dados primário;
- Execute `php artisan db:seed` para gerar dados de validação da aplicação

Após todos esses passos, você deverá ter a aplicação rodando na porta do seu webserver escolhido e a estrutura de dados configurada em seu SGBD.
