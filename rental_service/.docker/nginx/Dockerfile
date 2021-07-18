FROM nginx:1.15.0-alpine

# Adiciona o bash para eu poder me logar
RUN apk update && apk add bash

# Remover o arquivo de configuração default
RUN rm /etc/nginx/conf.d/default.conf

# Copia o meu arquivo de configuração
COPY ./nginx.conf /etc/nginx/conf.d
