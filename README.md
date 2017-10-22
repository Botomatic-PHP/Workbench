![img](http://botomatic.io/themes/botomatic/assets/images/logo_green@2x.png)

# Botomatic v1.0

The MIT License (MIT)

Copyright (c) Links der Isar <http://www.linksderisar.com>


Botomatic is a web application framework designed to help build chatbots for [Messenger Platform](https://developers.facebook.com/docs/messenger-platform/). Before reading this guide it is recommended to read the official documentation of Messenger Platform for a better understanding of chatbots development.

Depending on your development environment it is recommended to use either [Laravel Valet](https://laravel.com/docs/5.5/valet) on Mac or [Laravel Homestead](https://laravel.com/docs/5.5/homestead) on other systems

---

### Quick guide

This guide contains only the essentials to get you started fast, for a comprehensive understandig and advanced topics please read the official docs. 

1. Installation and configuration
2. Test locally
3. Basics
4. States
5. Message Handler
6. Response Handler
7. Templates
8. Default Bot
9. Register with Facebook

---

### 1. Installation and configuration


__1.1 Clone the repository__

```cli
git clone https://github.com/botomatic-php/workbench.git botomatic
```

__1.2 Environment configuration__

* Move `.env.example` to `.env`
* Make sure BOTOMATIC_FACEBOOK_DEBUG is set to true
* Set BOTOMATIC_FACEBOOK_TEST_URL to your project's url
* Setup any needed .env variables like database connection

__1.3 Install Botomatic__

* Install the framework with dependencies: `composer install`
* Generate an application key: `php artisan key:generate`

---

### 2. Test locally

To test the bot locally, you have to use the CLI Bot. Keep in mind it's very limited and made to be used only for development purposes

```cli
artisan bf:cli
```

You should see "Starting CLI Bot...:"

Type `hi`

It should respond with "Hello Test Test"

---

### 3. Basics

__3.1 Folder structure__

All Bot related files are in `app/Bot/Facebook` except for the configuration file which is located under `config/botomatic/facebook.php`

__3.2 States__

Botomatic structures the conversation in __states__. A state receives the message from the user and either responds or moves to another __state__.

Each state will have an additional 2 objects: `Handlers/Message` and `Handlers/Reponses` used to structure the code more efficiently, a simple process will look like this:

````php

	if ($this->message->saysHi())
	{
	    return $this->response->responseDefault();
	}

````

Any domain logic can be stored here but it is recommended to use a sepparate file to keep the code more readable.

The flow of the bot is controlled by the response, this returns `\Botomatic\Engine\Facebook\Abstracts\States\Response\Handler`


__3.3 Templates__

Messenger Platform supports different [Templates](https://developers.facebook.com/docs/messenger-platform/send-messages/templates/) like buttons, tiles, lists etc. 

Templates are stored in `app/Bot/Facebook/Templates/*Type*`, to send them as a response you simply "attach" them
to the response object:

````php

    return $this->response
        ->addQuickReplies(new \App\Bot\Facebook\Templates\QuickReplies\General\Options())
        ->sendResponse()
        ->setStatusActive();

````

More infromation on how to generate templates and their usage under __Response__ and __Templates__.

---

### 4. States

There are 4 types of __States__: Listener, Workflow, Fallback, Filters, and Background.

You can easily generate a state using this commands:

__Workflow__

```cli
artisan bf:state {namespace} {name}
```


__Filter__

```cli
artisan bf:filter {namespace} {name}
```

Where __namespace__ is the folder within the category, for example the default bot has all it's state's in __Test__ folder.

A state contains by default the following folders and files:

* StateName
* * Handlers
* * * Message.php
* * * Responses.php
* * StateName.php


__4.1 Listener__

This is the default __State__ that handles the start of the conversation. There can only be 1 Listener.

__4.2 Workflow__

Most of the conversation is handle by this type of __State__, the routing or "mapping" of them is defined in `app/Bot/Facebook/Routes/Workflow.php`.

By default, the status of a __State__ is "active", whenever it is changed, based on the mapping defined it moves to the next state. 

__4.3 Fallback__

Whenever the conversation fails by whatever reason the __Fallback State__ is called. There can only be 1 Fallback State.

__4.4 Filters__

Simple __States__ through which the incoming message passes through, they can stop the flow and respond with a message or "move" to another __Workflow__ state regardless of the current "active state".

There are 2 types of filters: 

* Regular filters through which all messages go
* Postback filters that only capture messages that contain a [Postback](https://developers.facebook.com/docs/messenger-platform/reference/webhook-events/messaging_postbacks/)

Postbacks are sent when a user clicks on a button within a template with the exception of Quick Replies which are sent as regular messages! 

Filters are mapped in `app/Bot/Facebook/Routes/Filters.php` and `app/Bot/Facebook/Routes/Postbacks.php`. The order in the array is the same order in which the message will go through.

__4.5 Background__

Background states are used to push a message to user(s) outside the context of a conversation, it can be a regular message or "jump" to a workflow state.

---

### 5. Message Handler

The message handler is a simple object that extend `\Botomatic\Engine\Facebook\Abstracts\States\Message\Handler`. 

This object contains the message (text, image, postback etc) received from the user. The following methods are available:


__Check if it's a text message__
```cli
$this->message()->isCallbackMessage()
```


__Get the text message__
```cli
$this->message()->getMessage()
```

__Get the text quick reply (payload) if available__
```cli
$this->message()->getQuickReply()
```

__Check if it's a Postback__
```cli
$this->message()->isCallbackPostback()
```

__Get the postback__
```cli
$this->message()->postback()
```

__Check for attachments__
```cli
$this->message()->hasAttachment()
```

__Get attachments__
```cli
$this->message()->getAttachment()
```

__Check for location__
```cli
$this->message()->hasLocation()
```

__Get location__
```cli
$this->message()->location()
```


---

### 6. Response Handler

The response handler contains "responses" defined as methods, it always returns `\Botomatic\Engine\Facebook\Entities\Response`. This is the object __States__ use to respond to the user. The object moves from state to state until it's returned to the user and any state can add or remove from it.

Response example:

```php
    public function responseDefault() : \Botomatic\Engine\Facebook\Entities\Response
    {
          return $this->response->addMessage('Hi there')
              ->setStatusActive()
              ->sendResponse();
    }
```

Available methods:

__Add a message__
```cli
addMessage(string $message)
```

You can add as many messages as you like (keep in mind Facebook's limitations), they will be sent in the same order they are called.

__Add Image (url)__

```cli
addImage(string $image)
```

__Ask for location__

```cli
askForLocation($title = 'Please share your location:')
```

__Stop the flow and respond to the user__

```cli
sendResponse()
```

__Delay the message__

```cli
delay($seconds = 1)
```

You can add several delays, the data is sent to facebook in the same order it's being defined.

Practical example:

```php
      return $this->response->addMessage('Hi there')
          ->delay(5)
          ->addMessage('Second message, sent after 5s')
          ->sendResponse();
```

__Add a quick reply__
```cli
addQuickReplies(new \App\Bot\Facebook\Templates\QuickReplies\General\Options())
```

---

### 7. Templates

Botomatic supports all [Templates](https://developers.facebook.com/docs/messenger-platform/send-messages/templates/) available for Messenger Platform.

For examples, check default bot.

__Generate new Quick Reply__

```cli
artisan bf:qr {namespace} {name}
```

__Generate Generic Template__

```cli
artisan bf:gt {namespace} {name}
```

__Generate Button Template__

```cli
artisan bf:bt {namespace} {name}
```

---

### 8. Default bot and CLI Bot

For practical examples on how a Bot is structured and various functionalities check the default bot located in `app/Bot/Facebook`

To play around, you can use the CLI Bot (`artisan bf:cli`).

__Buttons in CLI Bot__

Whenever the bot responds with a template, it will be displayed like this:

```cli
Quick Replies:  [Templates]  [Conversation]
```

To "press" one of the buttons simply type the button name. e.g. `Templates`

---

### 9. Register your bot with Facebook

Chatbots for Messenger Platform are Apps that are connected to specific Facebook pages. 

__1. Create Facebook App__

Go to [Facebook Apps](https://developers.facebook.com/apps/) and create a new one. From the Products selection choose __Messenger__

__2. Setup Webhook__

The webhook is the URL where Facebook will send messages from users, for development purposes it is recommeded you use services like ngrok to publicly share a local url. If you use Laravel Valet it's very easy, simply run `valet share`

Follow these steps to register your bot:

* set "BOTOMATIC_FACEBOOK_CONFIRMATION" to true in .env file
* click on __Setup Webhooks__ from the App's settings and add this url: `https://ngrok-url/webhook/facebook`
* inside "Verify Token" type "botomatic"
* from "Subscription Fields" select "messages" and "messaging_postbacks"
* click "Verify and Save"
* set BOTOMATIC_FACEBOOK_CONFIRMATION to false
* set BOTOMATIC_FACEBOOK_DEBUG to false

Next, you need a Facebook page where the bot will be accesibly from, under "Token Generation" select the Facebook page you want to link your bot; a "Page Access Token" is now generated. 

Next we need to tell botomatic to what pages it responds, go to and under __pages__ we store all pages that the bot has access to, grab the Facebook Page ID (you find this on Page's about section) and add it to the array with the access token

```php
   'pages' => [
        'page-id' => "Page Access Token"
    ],
```

Finally, we need to subscribe the Webhook to this page, under __Webhooks__ select the proper Facebook Page.

Now go to Facebook page and send a message.
