## Sobre

Sistema de ACL em Laravel e Bootstrap, controle de usuários e acessos já implementado. 

Esse é um projeto base para projetos que eu desenvolvo.

**Esse é um projeto pessoal**, existem alternativos como sugerido na documentação oficial de [instalação do Laravel](https://laravel.com/docs/9.x/installation).

Constuído com a framework [Laravel 9](https://laravel.com/) e utiliza como front-end o [Bootstrap 5.1](https://getbootstrap.com/).

#### Bibliotecas (que podem ser) utilizadas nos projetos:

- [typeahead](https://github.com/corejavascript/typeahead.js)
- [bootstrap-datepicker](https://github.com/uxsolutions/bootstrap-datepicker)
- [Inputmask](https://github.com/RobinHerbots/Inputmask)
- [Bootstrap Multiselect](https://github.com/davidstutz/bootstrap-multiselect)
- [Captcha for Laravel](https://github.com/mewebstudio/captcha) Nota: Habilitar a extenção extension=gd no php.ini
- [Laravel package for Fpdf](https://github.com/codedge/laravel-fpdf) **Muito velha**
- Utilizo os temas do site [Bootswatch](https://bootswatch.com/)

## Requisitos

Os requisitos para executar esse sistema pode ser encontrado na [documentação oficial do laravel](https://laravel.com/docs/9.x):

- Laravel 9.x requires a minimum PHP version of 8.0

## Funcionalidades

- Operadores* (usuários do sistema)
- Perfís de acesso
- Permissões

## Guia de intalação

### Requer

- Servidor apache com banco de dados MySQL instalado, se aplicável, conforme requisitos mínimos
- [Composer](https://getcomposer.org/download/) instalado
- [Git client](https://git-scm.com/downloads) instalado

**Dica:** [CMDER](https://cmder.net/) é um substituto do console (prompt) de comandos do windows.

### clonar o reposítório

```
git clone https://github.com/erisilva/acl80.git
```

não esquecer de usar o composer update para fazer download das libs do framework

```
composer update
```

### criar o banco de dados

para mysql

```
CREATE DATABASE nome_do_banco_de_dados CHARACTER SET utf8 COLLATE utf8_general_ci;
```

### configurações iniciais

criar o arquivo .env de configurações:

```
php -r "copy('.env.example', '.env');"
```

editar o arquivo .env na pasta raiz do projeto com os dados de configuração com o banco.

gerando a key de segurança:

```
php artisan key:generate
```

iniciando o store para os anexos (se o projeto precisar):

```
php artisan storage:link
```

### migrações

Executar a migração das tabelas com o comando seed:

```
php artisan migrate --seed
```

Serão criados 4 usuários de acesso ao sistema, cada um com um perfíl de acesso diferente.

Login: adm@mail.com senha:123456, acesso total.
Login: gerente@mail.com senha:123456, acesso restrito.
Login: operador@mail.com senha:123456, acesso restrito, não pode excluir registros.
Login: leitor@mail.com senha: 123456, somente consulta.

### executando

```
php artisan serve
```

## Licenças

Código aberto licenciado sob a [licença MIT](https://opensource.org/licenses/MIT).