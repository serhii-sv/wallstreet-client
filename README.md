Wallstreet

How to install:

- git clone git@bitbucket.org:serhii-v/wallstreet.git
- cd wallstreet
- If you would like to use Docker (installing may take some while, first time installing 30-60 min depends on your perfomance):
    - git clone https://github.com/Laradock/laradock.git laradock-wallstreet
    - cd laradock-wallstreet
    - cp .env.example .env
    - Change prefix in .env
    - docker-compose up -d nginx postgres php-fpm pgadmin workspace redis mailhog memcached
    - docker-compose exec workspace bash
- composer install
- cp .env.example .env
- php artisan install


postgre: - docker-compose up -d nginx postgres pgadmin php-fpm phpmyadmin workspace redis mailhog memcached
docker-compose exec workspace bash
