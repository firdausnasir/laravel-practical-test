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

| Method | Endpoint               | Description                              | Needs Authentication |
|--------|------------------------|------------------------------------------|----------------------|
| GET    | form/{uuid}            | Show survey form                         | No                   |
| GET    | form/{uuid}/edit       | Show edit survey form                    | Yes                  |
| GET    | form/{uuid}/responses  | Get survey form responses                | Yes                  |
| POST   | form/{uuid}/submit     | Submit survey form                       | No                   |
| GET    | api/form/input/all     | Get all form input ids                   | Yes                  |
| POST   | api/form/{uuid}/update | Update survey form questionnaire via api | Yes                  |

* User

| Method | Endpoint | Description       | Needs Authentication |
|--------|----------|-------------------|----------------------|
| GET    | user     | Show user profile | Yes                  |

## Example for updating survey form via API

* Get form input id from `api/form/input/all`

```json
{
  "data": [
    {
      "id": 1,
      "name": "Name",
      "type": "input"
    },
    {
      "id": 2,
      "name": "Phone Number",
      "type": "input"
    },
    {
      "id": 3,
      "name": "Date of Birth",
      "type": "input"
    },
    {
      "id": 4,
      "name": "Gender",
      "type": "input"
    }
  ]
}
```

* Choose the input id that you want to update
* Set the key name of the parameter to be the input id
* If you want to show the input in the form, set the value to `true`, else set it to `false`
* Update form via `api/form/{uuid}/update
* Key name that are not available in the list of input id will be ignored

```html
api/form/{uuid}/update?1=true&2=false&3=false&4=true
```

### Important

* Missing input id key parameter will not update the input visibility in the form survey
* All endpoints that needs authentication, you need to pass the `Authorization` header with the value
  of `Bearer {token}`
* You can get the token from `api/register` or `api/login`
* 