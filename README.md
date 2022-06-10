## DSpot Technical Test
This exercise includes a running configuration for <a target="_blank" href="https://docs.docker.com/engine/install">Docker</a>  and <a target="_blank" href="https://docs.docker.com/compose/install">Docker Compose</a>.

## Important notes

For the sake of simplicity, no volumes were attached to the database container, so all information will be persisted while the container is up and running.

A Swagger configuration was generated. If the default `8083` API port is to be changed, the `APP_URL` environment variable needs to be updated as well, the container needs to be rebuilt, and Swagger needs to be updated by running `php artisan swagger:generate`.

The backend container may start earlier than the database one, generating a temporary startup error. Docker will restart it until the database is ready to accept connections, so just wait a few seconds, and you should be good to go. 

## Steps
- Create a local copy of this repository by running `git clone https://github.com/fdbatista/dspot-test.git`.
- Make a copy of `.env.example` and name it `.env`. You may optionally change the database connection parameters if you don't want to use the default ones.
- Run `docker run --rm --interactive --tty --volume $PWD:/app composer:latest install` to download all required dependencies.
- Start the Docker containers with the command `docker-compose up -d`. You may pass additional parameters to the CLI by specifying `--build` and `--force-recreate` to make sure the containers get built with the latest version of the code.
- Navigate to `http://localhost:8083`.

## What would be next?
- Implement CI/CD with GitHub Actions.
- Paginate requests to RandomUser.me API after a given threshold to prevent errors.
