## About this code

The limited time that I had didnt allow me to create an app as I wanted.

a few things I would have done differently:

1) Images: I took the liberty of considering the json feed as a production copy. what that means is that after investigation I saw that all 3 images are exactly the same with the only difference the type field whch was pc,mobile,tablet. Also all the sizes were always exactly the same, width=234 and height 344. Takin this in mind I came to the conclusion that there is always one image and treated it as such. If I had more time I would have made an images table to manage different images seperately.

2) stats: In the current implementation stats are being overriden on update. I would love to have multiple stats instances per pornstar in order to provide historical info like trends etc.

3) For better or for worse I am not a designer. Given a template I can make any adjustments necesary but without it I am pretty much blind.

## Sail

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

all and all I do these steps to avoid writing:
```bash
vendor/bin/sail php artisan ...
# instead I write the following:
sail art
```

after this is done all you need to do to start the app is do the following

### Clone the repo

```bash
git clone git@github.com:gtrig/PornHubParser.git phb_test
cd phb_test
```

### Install dependencies
```bash
# install composer packages
composer install
#create .env
cp .env.example .env
#Generate the key
php artisan key:generate
#start sail
sail up -d
#Create links for images to be accessible
sail art storage:link
# install node packages
sail yarn install
# build yarn
sail yarn build
# finaly run the migrations
sail art migrate:fresh
```

you should be ready now to run the Application.

## Unit tests

The project has minimal test coverage. I would love to change this but the time was limited. To run the tests all you need to do is

```bash
sail test
```

## Using the app

### Pull the feed and push it to the DB
There is a command to run in order to pull the json file and push it into the database.

```bash
sail art app:update-feed
```

this process takes about 10-15 seconds and all it does is parsing the json file and setup jobs for creating the pornstars which in turn setup jobs to parse the images.

This can be achieved by starting the queue worker

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