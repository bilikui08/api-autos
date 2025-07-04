# API Autos

A RESTful API for managing cars reservations with Conectaas API.

## Features

- Authentication and authorization with Conectaas
- JSON responses
- Caching with Redis

## Technologies

- [Docker](https://www.docker.com/)
- [Slim4 Framework](https://www.slimframework.com/) (for PHP-based microservices)
- [Redis](https://redis.io/) (for caching and session management)

## Getting Started

### Prerequisites

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Redis](https://redis.io/)
- [PHP](https://www.php.net/) (for Slim4 Framework)

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/api-autos.git
    cd api-autos
    ```

2. Start the application:
    ```bash
    docker-compose up -d
    ```

3. Copy .env.dist to env.local
    ```bash
    cp .env.dist .env.local
    ```
4. Complete .env.local with local configs

5. The API will be available at `http://localhost:8080`.

## API Endpoints

| Method | Endpoint                 | Description                           |
|--------|------------------------- |---------------------------------------|
| GET    | /api/cars/players        | List all players cars                 |
| GET    | /api/cars/stores         | List all stote cars by playerId       |
| POST   | /api/cars/locations      | Create a new car                      |

## Example Request

```bash
curl -X GET http://localhost:3000/api/cars/players
```

## Slim4 & Redis Integration

- **Slim4 Framework** is used for building lightweight PHP-based microservices that can be integrated with the main API.
- **Redis** is used for caching frequently accessed data and managing user sessions, improving performance and scalability.

## License

MIT

## Author

Ola Develoment Team