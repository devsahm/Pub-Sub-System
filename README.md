## Pub/Sub system

This is a Pub/Sub System aimed to create subscription of all events of topics and publish the event to the topic



## Tools and Languages

* Laravel 
* Redis


### Features
* Create  subscription to all events of topics
* Publishing event to a topic

## Tools and Languages

* Laravel 
* Redis


Clone the project

```sh
git clone https://github.com/devsahm/Pub-Sub-System
cd notifier
composer install
```

Create .env file
```sh
cp .env.example .env
```

Start the publisher server (you can use any port of your choice, pass your desired port number after the --port=)

```sh
php artisan serve --port=8002
```

Start the subscriber server also using any port ( --port=)

```sh
php artisan serve --port=8000
```

Start queue 
```sh
php artisan queue:work
```
