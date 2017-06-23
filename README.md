# Thread

Thread is a small PHP library to manage simple multi-threading with async event handler. 
This library use the pcntlk_* forking function, so a basic installation of PHP is enough to use it.

## Getting Started

These instructions will get you a copy of the project up and running.

### Prerequisites

You need to have composer and autloader installed. To be able to install the package, add this entry 
in the "repositories" index of your composer.json 

```
      {
        "type": "vcs",
        "url":  "git@bitbucket.org:alicemajere/thread.git"
      }
```

### Installing

Just require the package with composer
```
composer require alicemajere/thread
```

### Usage

To start a multi-threading Pool, just create a new instance of ThreadPool
```
$threadPool = new ThreadPool(); 
```

We setup a maximum number of Thread to run at the same time. If we add 200 Threads to the Pool, only 5
of them will run at the same time until the Pool processed all the 200 Threads
```
$threadPool->setMaxRunningThreadNb(5);
```

Add one or more Thread to the Pool by creating a new instance of Thread. A Thread take two parameters,
a name and a closure function that will tell the Thread what to do. The closure have to return
an exit status from the ones defined in the Thread class constants.
```
$thread = ThreadFactory::create(
    'ThreadName',
    function ($processName) {
        // Implements the Thread processing here
        echo $processName . PHP_EOL;
        
        // return an exit status at the end of the thread
        return Thread::EXIT_STATUS_SUCCESS;
    }
)

$threadPool->addThread($thread);
```

To run the ThreadPool, you can just do 
```
$threadPool->run();
```

You can add Listeners that will trigger on a particular Event while the Pool is running the Threads.
Using Listeners can be useful if you need to do particular things for every Threads, like opening
a separate mysql connection for every Thread. A Listener object constructor need the Event name to 
listen to and a closure function that will tell the Listener what to do for this Event. The full list 
of Event definition is found in the 
Event class.

```
$threadPool->addListener(new Listener(
    Event::POOL_RUN_START, // Event to trigger the listener
    function (Event $event) use ($website) {
        // Implements the listener
    })
);
$threadPool->addListener(new Listener(
    Event::POOL_RUN_STOP,
    function (Event $event) {
        $this->io->progressFinish();
    })
);
```

## Running the tests

Work in progress

### Break down into end to end tests

Work in progress

## Contributing

Please send me a mail to my [mail](mailto:alice@jembee.com) if you want to contribute to the project.

## Versioning

I use [git](https://git-scm.com/) for versioning. For the versions available, see the 
[commits on master on this repository](https://bitbucket.org/alicemajere/thread/commits/branch/master). 

## Authors

* **Alice Praud** - *Initial work* - [AliceMajere](https://bitbucket.org/alicemajere/)
