## How to run
This exercise was designed to be executed using Docker:

- Create a local copy of this repository by running `git clone https://github.com/fdbatista/dspot-test.git`.
- Make a copy of `.env.example` and name it `.env`. You may optionally change the database connection parameters if you don't want to use the default ones.
- Run `docker run --rm --interactive --tty --volume $PWD:/app composer install` to download all required dependencies.
- Start the Docker containers with the command `docker-compose up -d`. You may pass additional parameters to the CLI by specifying `--build` and `--force-recreate` to make sure the containers get built with the latest version of the code.
- Navigate to `http://localhost:8083`.

## What's next
- Implement CI/CD with GitHub Actions.
