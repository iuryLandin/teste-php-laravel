![Logo AI Solutions](http://aisolutions.tec.br/wp-content/uploads/sites/2/2019/04/logo.png)

# AI Solutions

## Teste para novos candidatos (PHP/Laravel)

### Introdução

Este teste utiliza PHP 8.1, Laravel 10 e um banco de dados SQLite simples.

1. Faça o clone desse repositório;
1. Execute o `composer install`;
1. Crie e ajuste o `.env` conforme necessário
1. Execute as migrations e os seeders;

### Primeira Tarefa:

Crítica das Migrations e Seeders: Aponte problemas, se houver, e solucione; Implemente melhorias;

### Segunda Tarefa:

Crie a estrutura completa de uma tela que permita adicionar a importação do arquivo `storage/data/2023-03-28.json`, para a tabela `documents`. onde cada registro representado neste arquivo seja adicionado a uma fila para importação.

Feito isso crie uma tela com um botão simples que dispara o processamento desta fila.

Utilize os padrões que preferir para as tarefas.

Boa sorte!

______

# Minhas Considerações (iuryLandin)

Faltavam atributos (campos da tabela) na migration de documentos,
Além do `call` no arquivo "DatabaseSeeder".

Para realizar a migration por completo foi necessário remover o arquivo "sqlite-scheme.sql" pois como já existe as migrations no padrão laravel, não precisa de um SQL para criar e popular as tabelas;

Para melhor desenvolvimento, foi adicionado também a dependencia "laravelcollective/html".

O comando de migration foi executado com sucesso, porém ao realizar testes de insersão de dados foi notado que precisava configurar o arquivo "config/database.php", adicionando a função `base_path('/')` presente no _helper_ do laravel, para assim ter o caminho relativo do arquivo de banco de dados do Sqlite, além disso precisei baixar o SQLite3 e configurar as variaves de ambiente do sistema windows para executar comandos do Artisan.

______

## Como executar

Para "rodar" a aplicação, execute os seguintes comandos
- `composer install`
- `npm install`
- `php artisan migrate:fresh --seed` // isso irá limpar o banco recriar as tabelas e executar a seed;
- `php artisan serve`
