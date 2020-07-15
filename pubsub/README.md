# Publishing/Subcribing Sub-System

A simple publishing/subscription sub-system using HTTP requests.

## Installing / Getting Started

Simply clone project into a folder of your choosing from GitHub.

### Initial Configuration

Nothing special to do here at the moment.

## Developing

The following are instructions to get the application set and running up on your machine
1. Clone this repo to a local folder
1. Create a database named "pubsub"
1. Create a copy of the ".env.example" file as ".env"
1. Update the "DB_*" variables to the desired values (specifically, DB_DATABASE=pubsub, but you may need to update others depending on your database server configuration and user credentials)
1. In a terminal window, navigate to the pubsub folder and install both Composer and NPM packages using the following commands (note: these installations will likely take a while to complete):
    ```
    cd pubsub
    composer install
    npm install
    ```
1. Generate an application key and set the value in your new ".env" file in the "" variable's value. Use this command:
    ```
    php artisan key:generate
    ```
1. Create a configuration cache using the following command:
    ```
    php artisan config:cache
    ```
1. Migrate database schemas to the database you created and wired up earlier using this command:
    ```
    php artisan migrate
    ```
1. Use Webpack to compile resources and continue to compile resources as they changed by running this command:
    ```
    npm run watch
    ```
    Keep this terminal window open while you are developing and testing to ensure that resources are compiled into the public folder as you add, remove and update them.

1. Open a new terminal window, navigate to the 'pubsub' folder and get a test server running by exceuting the following commands:
    ```
    cd pubsub
    php artisan serve
    ```
    As with the webpack compiler, keep this window open as you are developing and testing to keep the web server running

1. Navigate to <a href="http://localhost:8000/">http://localhost:8000/</a> in a browser. The Welcome page should be displayed if everything was set up correctly.

### Building

When assembling a "build", or a copy of what you will deploy over to your web server, you can manually exclude some files when copying over to your web server, such as:
1. This readme
1. The .git folder
1. The .gitignore file

### Deploying / Publishing

1. Copy all contents from your build above to your web server root.
1. Ensure all necessary site bindings are in place to serve this site as a localhost request on port 8000.
1. Open up a browser and surf on over to http://localhost:8000/ and confirm that you see the "Welcome!" page

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

URL: http://localhost:8000/event

A test page that displays published event data

### Homepage (Webpage)

URL: http://localhost:8000/

Just a welcome page to confirm that you serving that the API is serving correctly.

## Configuration

No configuration options at the moment

## Contributing

This is only a sinple one-off coding exercise at the moent. Feel free to fork and use as you like, but this system will not be maintained going forward.

## Links

Original requirements for this exercise can be found here: https://pangaea-interviews.now.sh/be


## Licensing

No license. Do whatever you want with this!
