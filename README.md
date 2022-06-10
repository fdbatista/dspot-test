## DSpot Technical Test
This exercise includes a running configuration for <a target="_blank" href="https://docs.docker.com/engine/install">Docker</a>  and <a target="_blank" href="https://docs.docker.com/compose/install">Docker Compose</a>.

## Important notes
The backend container may start earlier than the database one, generating a temporary startup error. Docker will restart it until the database is ready to accept connections, so just wait a few seconds, and you should be good to go.

No volumes were attached to the database container, so all information will be persisted while the container is up and running.

For the sake of simplicity, the `.env.example` file comes with sensitive data already loaded to speed things up, so you don't need to adjust any value.

A Swagger configuration was generated. If the default `8083` API port is to be changed, the `APP_URL` environment variable needs to be updated as well, the container needs to be rebuilt, and Swagger needs to be updated by running `php artisan swagger:generate`.

An exception related to the Swagger generator will be thrown after running the `composer install` command with a Composer Docker container, but dependencies will be correctly downloaded. I had two options: removing the Swagger generator and thus adding lots of ugly decorators and annotations to my controllers or learning to live in peace with this exception. I chose the second. Anyways, the `composer install` will be executed again in the next step from within the API container itself, just to make sure everything is ok. 

## Steps
- Create a local copy of this repository by running `git clone https://github.com/fdbatista/dspot-test.git`.
- Make a copy of `.env.example` and name it `.env`.
- Run `docker run --rm --interactive --tty --volume $PWD:/app composer:latest install` to download all required dependencies.
- If the previous step throws an exception at the end, run `docker exec dspot-api composer install` to make sure all dependencies were downloaded correctly.
- Start the Docker containers with the command `docker-compose up -d`. You may pass additional parameters to the CLI by specifying `--build` and `--force-recreate` to make sure the containers get built with the latest version of the code.
- Apply database migrations: `docker exec dspot-api php artisan migrate`.
- Run profiles and connections seeder script by executing `docker exec dspot-api php artisan profiles:seed {profilesTotal} {friendsTotal}`. Replace `{friendsTotal}` and `{friendsTotal}` by the respective values you'd like.
- Browse Swagger documentation available on `http://localhost:8083/doc` to get the list of available endpoints.

## Unix-like OS commands

```shell
git clone https://github.com/fdbatista/dspot-test.git
cp .env.example .env
docker run --rm --interactive --tty --volume $PWD:/app composer:latest install
docker exec dspot-api composer install
docker-compose up -d
docker exec dspot-api php artisan migrate
docker exec dspot-api php artisan profiles:seed 10 15
curl http://localhost:8083
```

## What would be next?
- Paginate requests to RandomUser.me API after a given threshold to prevent errors.
- Implement CI/CD with GitHub Actions.
