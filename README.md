# Tasks (Coalition Technologies)

This is the setup guide for the Project Name. It will walk you through the steps to set up and deploy the project.

## Prerequisites

Before you begin, make sure you have the following installed on your system:

-   PHP (minimum version 7.4)
-   Composer
-   Web server (e.g., Apache or Nginx)
-   MySQL or any other supported database server

## Local Development Setup

Follow the steps below to set up the project locally:

1.  Clone the project repository:

    ```bash
    git clone <repository_url>
    ```

2.  Change into the project directory:

    ```bash
    cd tasks
    ```

3.  Install the project dependencies using composer:

    ```bash
     composer install
    ```

4.  Create a new .env file by copying the .env.example file:

    ```bash
    cp .env.example .env
    ```

5.  Generate a new application key:

    ```bash
     php artisan key:generate
    ```

6.  Update the .env file with your local database credentials:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=tasks
    DB_USERNAME=<your_database_username>
    DB_PASSWORD=<your_database_password>
    ```

7.  Run the database migrations:

    ```bash
    php artisan migrate
    ```

8.  Start the local development server:

    ```bash
    php artisan serve
    ```

9.  Open your web browser and visit http://localhost:8000 to see the application running.
