## About this test
- There was an error on the DB dump file. A trailing comma where a semicolon was supposed to be.

## How to run
- This repository includes a working Docker setup.
- First, create a required Docker network by running `docker network create caol-network`
- Create a `.env` by copying it from `.env.example` and generate a secure key for signing your JWTs. Adjust database parameters accordingly.
- Run `composer install` or `docker run --rm --interactive --tty --volume $PWD:/app composer install` to download all required dependencies.
- If running on localhost, start the Docker containers with the command `docker-compose -f docker-compose.local.yml up -d`. You may pass additional parameters to the CLI by specifying `--build` and `--force-recreate` to make sure the containers get built with the latest version of the code.
- Run `docker-compose up -d` and you should be good to go.
- Navigate to `http://localhost:8085`.

## What's next
- Implement CI/CD with Github Actions.
