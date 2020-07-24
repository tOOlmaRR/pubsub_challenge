# Publishing/Subcribing Sub-System

A simple publishing/subscription sub-system using HTTP requests.

## Installing / Getting Started

The following are instructions to get the application set and running up on your machine
1. Clone this repo to a local folder.
1. Create two databases, one named _pubsub_ and another named _pubsub\_testing_. Do not create any schema (tables etc.). These will be created using Laravel's ORM (Eloquent) via migrations.
1. Create a copy of the ".env.example" file and name it ".env". This file defines the local environment configuration.
1. Generate an application key (to secure user sessions and encrypted data) by using this command:
    ```
    php artisan key:generate
    ```
    Your ".env" file should be updated automatically (see the "APP_KEY" setting).
1. Create a copy of your new ".env" file (now containing the generated application key), name it ".env.testing", update DB_DATABASE to _pubsub\_testing_, and update APP_ENV to _testing_. This file defines the "testing" environment configuration which is used by automated tests.
1. Update the "DB_*" variables within the ".env" file to the desired values. Specifically, DB_DATABASE should be set to _pubsub_, but you may also need to update others depending on your database server configuration and user credentials.
1. In a terminal window, navigate to the _pubsub_ folder and install both Composer and NPM packages using the following commands (note: these installations will likely take a while to complete):
    ```
    cd pubsub
    composer install
    npm install
    ```
1. Create a configuration cache for both the local environment by using the following commands:
    ```
    php artisan config:cache
    ```
1. Migrate database schema to both databases that you created and wired up earlier using these commands:
    ```
    php artisan migrate
    php artisan migrate --env=testing
    ```
    This also creates the migration table in the database for tracking migrations
1. Use Webpack to compile resources and continue to compile resources in the background as they are changed by running this command:
    ```
    npm run watch
    ```
    __Note__: Keep this terminal window open while you are developing and testing to ensure that resources are compiled into the public folder as you add, remove and update them.

1. Open a new terminal window, navigate to the _pubsub_ folder and get a test server running by executing the following commands:
    ```
    cd pubsub
    php artisan serve
    ```
    __Note__: As with the Webpack compiler, keep this window open as you are developing and testing to keep the web server running.

1. Navigate to <a href="http://localhost:8000/">http://localhost:8000/</a> in a browser. The Welcome page should be displayed if everything was set up correctly.

1. Feel free to test out the Subscribe and Publish endpoints using Postman or some other utility. I have shared a small Postman collection at the following URL: https://www.postman.com/collections/676b9f44ac22b9a9bc3c. If you have Postman installed, you can import this collection via this URL.

1. Try running all automated tests that have been created for this application by running the following command:
    ```
    php artisan test
    ```

## Features

### Subscribe (API Endpoint)
```
POST /subscribe/{TOPIC}
BODY { url: "http://localhost:8000/event"}

Create a subscription for all events of {TOPIC} and forward data to http://localhost:8000/event
```

### Publish (API Endpoint)
```
POST /publish/{TOPIC}
BODY { "message": "hello"}

Publishes whatever is passed in the body (in JSON format) to the supplied topic in the URL. This endpoint will trigger a forwarding of the data in the body to all of the currently subscribed URL's for that topic.
```

### Event (Webpage)
```
GET: /event

A test page that displays published event data that this page is subscribe to.
```

### Homepage (Webpage)
```
GET: /

Just a welcome page to confirm that the basic application is serving correctly.
```

## Contributing

This is only a simple one-off coding exercise at the moment. Feel free to fork and use as you like, but this system will not be maintained going forward.

## Links

Original requirements for this exercise can be found here: https://pangaea-interviews.now.sh/be

## Licensing

No license. Do whatever you'd like with this!
