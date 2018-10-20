[![Build Status](https://travis-ci.org/AliceMajere/wonderland-thread.svg?branch=master)](https://travis-ci.org/AliceMajere/wonderland-thread) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/AliceMajere/wonderland-thread/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/AliceMajere/wonderland-thread/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/AliceMajere/wonderland-thread/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/AliceMajere/wonderland-thread/?branch=master) [![Code Intelligence Status](https://scrutinizer-ci.com/g/AliceMajere/wonderland-thread/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

# Wonderland Thread

A small simple multi-threading library to include in projects

## Recent Update

Current updating the project with unit test, builds and soon packagist

## Installation

You need to have composer and autloader installed. To be able to install the package, add this entry 
in the "repositories" index of your composer.json 

```
      {
        "type": "vcs",
        "url":  "git@github.com:AliceMajere/wonderland-thread.git"
      }
```

Just require the package with composer
```
composer require alicemajere/wonderland-thread
```

### Usage

To start a multi-threading Pool, just create a new instance of ThreadPool
``` php
$threadPool = new ThreadPool(); 
```

We setup a maximum number of Thread to run at the same time. If we add 200 Threads to the Pool, only 5
of them will run at the same time until the Pool processed all the 200 Threads
``` php
$threadPool->setMaxRunningThreadNb(5);
```

Add one or more Thread to the Pool by creating a new instance of Thread. A Thread take two parameters,
a name and a closure function that will tell the Thread what to do. The closure have to return
an exit status from the ones defined in the Thread class constants.
``` php
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

``` php
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

## Prerequisites

PHP >= 7.2

## Getting help

If you've instead found a bug in the library or would like new features added, go ahead and open issues or pull requests against this repo!

## Authors

* **Alice Praud** - *Initial work* - [AliceMajere](https://github.com/AliceMajere/wonderland-thread/)
