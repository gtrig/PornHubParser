## About this code

I am using sail to dockerize this app.
There are some aliases that are needed in order to make the experience a bit better.
The following needs to go to ~/.bashrc or ~/.zshrc

```bash
alias sail="vendor/bin/sail"
```

I have also added an alias in the dockerfile for brevity.
This is embeded in the dockerfile and there is no need for you to do anything.


```bash
alias art="php artisan"
```

in order to use it you need to build the sail dockerfile with the following command. if you havent used sail before it will be automatically done in the next step.

```bash
sail build --no-cache
```

after this is done all you need to do to start the app is

```bash
sail up -d
```

## Using the app

### Pull the feed and push it to the DB
There is a command to run in order to pull the json file and push it into the database.

```bash
sail art app:update-feed
```

this process takes about 60-80 seconds and when done all pornstars with their attributes and stats are in the database.

The only thing that remains is to download the images and this can be done by starting the queue worker with the following command.

```bash
sail art queue:work
```

please keep in mind that you can start multiple workers since this job is done asynchronously. I have tried this with 8 workers and it completes the task quite fast.

### See the results

You can now see the results by visiting http://localhost.

## Close sail

In order to terminate sail and close the app you need to run the following command:

```bash
sail down
```

for any extra information please dont hesitate to contact me at gtrig84(at)gmail.com