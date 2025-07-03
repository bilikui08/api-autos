# API Autos

A RESTful API for managing automobile data.

## Features

- CRUD operations for cars
- Search and filter vehicles
- Authentication and authorization
- JSON responses
- Caching with Redis

## Technologies

- Docker
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
    docker-compose up
    ```

3. The API will be available at `http://localhost:3000`.

## API Endpoints

| Method | Endpoint         | Description           |
|--------|------------------|----------------------|
| GET    | /api/cars        | List all cars        |
| GET    | /api/cars/:id    | Get car by ID        |
| POST   | /api/cars        | Create a new car     |
| PUT    | /api/cars/:id    | Update a car         |
| DELETE | /api/cars/:id    | Delete a car         |

## Example Request

```bash
curl -X GET http://localhost:3000/api/cars
```

## Slim4 & Redis Integration

- **Slim4 Framework** is used for building lightweight PHP-based microservices that can be integrated with the main API.
- **Redis** is used for caching frequently accessed data and managing user sessions, improving performance and scalability.

## License

MIT

## Author

Your Name