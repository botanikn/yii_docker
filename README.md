# Что нужно для поднятия проекта

1. wsl Ubuntu
2. docker desktop

# Как поднять проект
## Все дальнейшие действия осуществляются в wsl

1. git clone https://github.com/botanikn/yii_docker.git
2. В корне проекта docker-compose up -d
3. docker exec -it yii-app bash
4. composer install
5. php yii migrate

Подключение к фронтенду по адресу - localhost:3000