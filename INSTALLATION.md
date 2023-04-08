# Installation

## Requirements

- PHP 8.1+
- Composer
- MySQL

## Installation

* Create an empty database for your application (MySQL/MariaDB).
* Copy the content from .env.example and put it into .env file.
* Replace value tagged with 123 inside the .env file.
* Run composer to install all the dependencies required.

    ```bash
    composer install
    ```
* Run database migrations to create tables inside database.

    ```bash
    php artisan migrate --seed
    ```

* And you're done.

## Endpoints

* Registration

| Method | Endpoint     | Description                 | Needs Authentication |
|--------|--------------|-----------------------------|----------------------|
| GET    | register     | Show registration form      | No                   |
| POST   | register     | Register a new user         | No                   |
| POST   | api/register | Register a new user via api | No                   |

* Login

| Method | Endpoint     | Description                 | Needs Authentication |
|--------|--------------|-----------------------------|----------------------|
| GET    | login        | Show login form             | No                   |
| POST   | login        | Login existing user         | No                   |
| POST   | api/register | Login existing user via api | No                   |

* Logout

| Method | Endpoint   | Description                  | Needs Authentication |
|--------|------------|------------------------------|----------------------|
| POST   | logout     | Logout existing user         | Yes                  |
| POST   | api/logout | Logout existing user via api | Yes                  |

* Survey

| Method | Endpoint                 | Description                              | Needs Authentication |
|--------|--------------------------|------------------------------------------|----------------------|
| GET    | survey/{uuid}            | Show survey form                         | No                   |
| GET    | survey/{uuid}/edit       | Show edit survey form                    | Yes                  |
| GET    | survey/{uuid}/responses  | Get survey form responses                | Yes                  |
| POST   | survey/{uuid}/submit     | Submit survey form                       | No                   |
| POST   | api/survey/{uuid}/update | Update survey form questionnaire via api | Yes                  |

* User

| Method | Endpoint | Description       | Needs Authentication |
|--------|----------|-------------------|----------------------|
| GET    | user     | Show user profile | Yes                  |
