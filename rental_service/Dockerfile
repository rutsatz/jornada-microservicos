# Imagem oficial do PHP, que vai utilizar o PHP FPM.
# Vamos trabalhar com o NGINX, e toda requisição que cair nele, vai
# bater no php fpm, que vai retornar. Então não vamos usar Apache.
# Vamos trabalhar em um modo FastCGI.
FROM php:7.3.6-fpm-alpine3.9

# apk é o gerenciador de pacotes do Linux Alpine
RUN apk add --no-cache openssl bash mysql-client nodejs npm

# A imagem já vem com ums cript php, que permite que a gente consiga
# instalar extensões do php através do comando abaixo.
# Nesse caso, instalamos o pdo do mysql para trabalhar com o banco.
# E também uma extensão necessária para o Laravel Nova
RUN docker-php-ext-install pdo pdo_mysql bcmath

WORKDIR /var/www

# A imagem vem com uma pasta html que não usamos, então podemos excluir.
RUN rm -rf /var/www/html

# O laravel tem uma pasta public onde ficam os arquivos. Porém, o nginx
# usa uma pasta html. Então para evitar qualquer problema com o nginx,
# vamos criar um link simbólico que vai apontar para a pasta public.
RUN ln -s public html

# Instalamos o composer, que é o gerenciador de pacotes do php.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Porta onde o php fpm vai rodar
EXPOSE 9000

# Processo principal que o container vai rodar quando iniciar
# O comando php-fpm é o que sobe e deixa o server php de pé
ENTRYPOINT ["php-fpm"]
