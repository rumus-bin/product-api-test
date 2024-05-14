# Project Name

This application is built using the Laravel version 10 framework and Docker environment.

## Features

- User authorization logic using Laravel Sanctum functionality.
- A routing system with both public routes and routes protected by authorization logic.

## Authorization

To gain access to protected routes, HTTP requests must include the `Authorization` header with the value `Bearer {token}`.

## Deployment Instructions

To deploy the project on your local computer (with Docker and Docker Compose installed), follow these steps:

1. **Clone the repository:**
   ```bash
   git clone {repository_url}
   cd {repository_name}
2. **Set up environment variables:**
   ```bash
   cp .env.example .env
   ```
   Update the .env file with the required values, such as APP_PORT and database configuration.
3. *Build the Docker environment:**
   ```bash
   ./vendor/bin/sail build --no-cache
   ```
   
4. **Launch Docker containers:**
   ```bash
   ./vendor/bin/sail up
    ```
 - To run the containers in the background without displaying logs, add the -d flag:
   ```bash
   ./vendor/bin/sail up -d
   ```

5. **Install dependencies:**
   ```bash
    ./vendor/bin/sail composer install
    ```
   
6. **Generate the application key:** 
   ```bash
   ./vendor/bin/sail artisan key:generate
    ```
   
7. **Run database migrations:**
    ```bash
    ./vendor/bin/sail artisan migrate
     ```
8. **Seed the database with sample data:**
    ```bash
    ./vendor/bin/sail artisan db:seed
     ```

## API Documentation ##
API routes are documented using the OpenAPI (Swagger) package.

To access the API documentation, navigate to:
```bash
  http://{your_local_host:your_app_port}/api/v1/documentation
```

If you cannot access the documentation after deploying the project, try regenerating it with:

```bash
  ./vendor/bin/sail artisan l5-swagger:generate
```

## Testing ##
To run the test suite, execute the following command:
```bash
  ./vendor/bin/sail test
```

### Additional Notes ###
- The application uses the Laravel Sail package to manage Docker containers.
- You can access the running Docker containers using vendor/bin/sail {console command} or by directly logging into the Docker container.
  For more detailed information on using Laravel Sail and Docker, refer to the [Laravel documentation](https://laravel.com/docs/10.x/sail).


## License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).



