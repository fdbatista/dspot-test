## How to run
- This repository includes a working Docker setup.
- Create a required Docker network by running `docker network create dspot-network`
- Create a `.env` by copying it from `.env.example`. Adjust database connection parameters.
- Run `docker run --rm --interactive --tty --volume $PWD:/app composer install` to download all required dependencies.
- Start the Docker containers with the command `docker-compose -f docker-compose.local.yml up -d`. You may pass additional parameters to the CLI by specifying `--build` and `--force-recreate` to make sure the containers get built with the latest version of the code.
- Navigate to `http://localhost:8083`.

## What's next
- Implement CI/CD with GitHub Actions.
