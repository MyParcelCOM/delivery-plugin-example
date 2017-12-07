#!/usr/bin/env bash
set -eo pipefail

# When one or more arguments are passed...
if [ $# -gt 0 ]; then
  # Install dependencies.
  if [ $1 == "setup" ]; then
    cp ./.env.dist ./.env
    ./mp.sh composer install

  # Start the application.
  elif [ $1 == "up" ]; then
    docker-compose up -d

  # Run composer in the container.
  elif [ $1 == "composer" ]; then
    shift 1 # Remove 'composer' from the arguments passed to the command.
    docker-compose run --rm app composer "$@"
    docker-compose run --rm app chown -R $(id -u):$(id -g) .

  else
    # Run docker-compose with given arguments.
    docker-compose "$@"
  fi
else
  # ...else show a list of running services.
  docker-compose ps
fi
