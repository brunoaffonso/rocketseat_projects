FROM php:8.4.12-zts-alpine3.22

WORKDIR /usr/src/app

COPY . .

# RUN php -S localhost:8888

EXPOSE 8888

CMD ["php", "-S", "0.0.0.0:8888", "-t", "/usr/src/app"]