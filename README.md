# Publishing/Subcribing Sub-System
> Additional information or tagline

A simple publishing/subscription sub-system using HTTP requests.

## Installing / Getting Started

Simply clone project into a folder of your choosing from GitHub.

### Initial Configuration

Nothing special to do here at the moment.

## Developing

Once you've cloned the repo, and set it up in a test environment (see "Installing / Getting Started" above), just dig in and have fun!

### Building

When assembling a "build", or a copy of what you will deploy over to your web server, you can manually exclude some files when copying over to your web server, such as:
1. This readme
1. The .git folder
1. The .gitignore file

### Deploying / Publishing

1. Copy all contents from your buidl above to your web server root.
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

### Welcome (Webpage)

URL: http://localhost:8000/welcome

Just a welcome page to confirm that you serving that the API is serving correctly.

## Configuration

No configuration options at the moment

## Contributing

This is only a sinple one-off coding exercise at the moent. Feel free to fork and use as you like, but this system will not be maintained going forward.

## Links

Original requirements for this exercise can be found here: https://pangaea-interviews.now.sh/be


## Licensing

No license. Do whatever you want with this!