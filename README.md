# SeQura Challenge 

I have use Laravel to implement the challenge, so I leave you the instructions to set up the application.

## Requirements
### MacOS & Windows
- Docker Desktop
### Linux
- Docker Compose

## Set up environtment

### Install dependencies
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
### Config

Prepare config
```bash
cp .env.example .env
```
You can use the default config.

### Wake up the environment
```bash
./vendor/bin/sail up
```

### Running migrations
```bash
./vendor/bin/sail artisan migrate
```

### Seeding database
```bash
./vendor/bin/sail artisan db:seed
```

### Listen for jobs execution
```bash
./vendor/bin/sail artisan queue:work
```

### Execute job
In a separated terminal execute th schedule command
```bash
./vendor/bin/sail artisan schedule:run
```
This command executes the disbursements calculation and processes a batch of 500 items per run.

Now the disbursements should appear in the disbursements table.

### Get disbursements through API
At this point you must be able to get the disbursements through the API.

There's one endpoint only at ```/disbursements```, is required to pass week param, based on year week. The merchant param is optional.
