

# DARTWEEK COPA DO MUNDO
- Uma estrutura completa utilizando docker para utilização das APIS

# ESTRUTURA
 * [Laravel](https://laravel.com)
 * [nginx:alpine](https://hub.docker.com/_/nginx) - [versions](https://nginx.org/en/CHANGES)
 * [php:8.1.0-fpm](https://hub.docker.com/_/php)
 * [redis:alpine](https://hub.docker.com/_/redis)
 * [phpmyadmin:latest](https://hub.docker.com/_/phpmyadmin)
 * [Mysql 5.7.22](https://hub.docker.com/_/mysql)
 * [Node 16 LTS](https://github.com/nodesource/distributions#debmanual)
 * [Mail Hog](https://github.com/mailhog/MailHog)


 # PROCEDIMENTO A SER EXECUTADO

Clone o repositório 

**é necessário que você tenha o docker instalado no seu computador**


----

Vamos fazer o deploy dos containers do projeto entrando no diretório clonado e digitando os seguintes comandos
```sh
docker-compose up -d
```

Depois disso vamos abrir o phpmyadmin (http://localhost:8181)  e criar um banco de dados com o nome '**dw-copa-do-mundo**'


Para acessar o container
```sh
docker-compose exec app bash
```

Execute os seguintes comandos
```sh
composer install
```
depois
```sh
php artisan key:generate
```
e depois
```sh
php artisan config:cache
```

e por ultimo
```sh
php artisan migrate
```

Urls uteis

- Para acessar a sua aplicação  http://localhost:8180 ou  http://ipinterno:8180
- Para acessar o phpmyadmin http://localhost:8181 ou http://ipinterno:8181
- Para acessar o e-mail http://localhost:8100/ ou http://ipinterno:8100

<br>

**Observação:**
- Caso tente refazer build da sua aplicação com **docker-compose up -d --build** e se aparecer um  erro, 
  verifique  a pasta **docker/mysql/dbdata** se ela estiver protegida para escrever, alterar ou excluir, use o esse
  comando do linux para da permissão na pasta.
- Não esqueça que para executar esse comando, abra o terminal dentro da pasta **docker/mysql/**

```sh
  chmod -R 777 dbdata
```


## COMANDOS DOCKER

Para parar todos containers de uma vez
```sh
docker stop $(docker ps -qa)
```

Para remover os containers
```sh
docker rm $(docker ps -qa)
```

Para remover todas as imagens de uma vez
```sh
docker rmi $(docker images -qa)
```

Para remover uma imagem especifica a força
```sh
docker rmi -f aqui_voce_digita_codigo_da_imagem
```
- **Observação:** Não precisa digitar o código todo,  os 3 primeiros caracteres do código já serve.
