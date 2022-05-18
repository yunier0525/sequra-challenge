# SeQura Challenge 

I have use Laravel to implement the challenge, so I leave you the instructions to set up the application.

## Requirements
### MacOS & Windows
- Docker Desktop
### Linux
- Docker Compose

## Set up environtment
```bash
./vendor/bin/sail up
```

## Set up App

Enter to bash session
```bash
./vendor/bin/sail bash
```

Prepare config
```bash
cp .env.example .env
```
Adjust the params with database name and credentials.

Default credentials are:
```
DB_USERNAME=sail
DB_PASSWORD=password
```

### Running migrations
```bash
php artisan migrate
```

### Seeding database
```bash
php artisan db:seed
```

### Listen for jobs execution
```bash
php artisan queue:work
```

### Execute job
In a separated terminal execute th schedule command
```bash
php artisan schedule:run
```
This command executes the disbursements calculation and processes a batch of 500 items per run.

Now the disbursements should appear in the disbursements table.

### Get disbursements through API
At this point you must be able to get the disbursements through the API.

There's one endpoint only at ```/disbursements```, is required to pass week param, based on year week. The merchant param is optional.
