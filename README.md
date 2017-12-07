# Delivery Plugin Example

[![GitHub release](https://img.shields.io/github/release/MyParcelCOM/delivery-plugin-example/all.svg)](https://github.com/MyParcelCOM/delivery-plugin-example)

> An example project built in [Slim Framework](https://www.slimframework.com/) using the MyParcel.com [Delivery Plugin](https://github.com/MyParcelCOM/delivery-plugin) and [API-SDK for PHP](https://github.com/MyParcelCOM/api-sdk-php).

## Content
- [Installation](#installation)
- [Setup](#setup)
- [Commands](#commands)

### Installation
The project uses Docker to run a local development environment. To install Docker, follow the steps below for your preferred OS.

#### Mac
Install Docker for Mac from [https://docs.docker.com/docker-for-mac/install/](https://docs.docker.com/docker-for-mac/install/).

#### Windows
Install Docker for Windows from [https://docs.docker.com/docker-for-windows/install/](https://docs.docker.com/docker-for-windows/install/).

#### Linux
Install Docker by running the following command:
```bash
curl -sSL https://get.docker.com/ | sh
```

Then install Docker Compose by following the instructions [here](https://github.com/docker/compose/releases).

Finally assign yourself to the Docker group:
```bash
sudo usermod -aG docker $(whoami)
```

### Setup
To setup the project (install dependencies, etc), run the following command:
```bash
./mp.sh setup
```

#### Credentials
Afterwards enter your credentials and configuration in the newly created `.env` file.

#### Visiting in the browser
The project wil run at `http://localhost` on the port you specified in your `.env` file.

#### Google Maps Key
The Delivery Plugin requires a Google Maps API key to run. You can get one [here](https://console.cloud.google.com/apis). Make sure both the `Google Maps JavaScript API` and the `Google Maps Geocoding API` are enabled.

When you visit the project in the browser, input the Google Api key in the field and press *Save*.

### Commands
The following commands are available:
- `./mp.sh` - List created containers (for this project).
- `./mp.sh up` - Start the application.
- `./mp.sh down` - Stop the application.
- `./mp.sh setup` - Setup the application.
- `./mp.sh composer <args>` - Run composer inside the app container.
