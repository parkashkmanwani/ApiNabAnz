# ApiNabAnz

Payment Gateway for NAB and ANZ

# Development Steps

- Clone the repo
- Run `docker-compose build --no-cache` to build docker image.
- Run `docker-compose up -d` to bring up all services.
- Run `composer update` inside laravel-app service to make sure dependencies are up to date.
- NAB API and ANZ API url setup through .env file.
- Project should be accessible at `localhost:8233`.
- Run `./vendor/bin/phpunit` to run the test cases.
