#!/usr/bin/env bash
set -eo pipefail

# When one or more arguments are passed...
if [ $# -gt 0 ]; then
  # Install dependencies.
  if [ $1 == "install" ]; then
    docker-compose run --rm app composer install
    docker-compose run --rm app chown -R $(id -u):$(id -g) .

  # Start the application.
  elif [ $1 == "up" ]; then
    docker-compose up -d

  else
    # Run docker-compose with given arguments.
    docker-compose "$@"
  fi
else
  # ...else show a list of running services.
  docker-compose ps
fi
