## Pub/Sub system

This is a Pub/Sub System aimed to create subscription of all events of topics and publish the event to the topic



## Tools and Languages

* Laravel - Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things. 

* Redis- The open source, in-memory data store used by millions of developers as a database, cache, streaming engine, and message broker.


### Features
* Create  subscription to all events of topics
* Publishing event to a topic



Clone the project

```sh
git clone https://github.com/devsahm/Pub-Sub-System
cd ulession-task
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
