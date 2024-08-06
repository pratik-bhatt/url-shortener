# URL Shortening Service

This project is a URL shortening service built with Laravel. It allows you to shorten long URLs using two methods: via Artisan commands or via API requests.

## Table of Contents

1. [Installation](#installation)
2. [Usage](#usage)
    - [Using Artisan Commands](#using-artisan-commands)
    - [Using API via Postman](#using-api-via-postman)
3. [Testing](#testing)
4. [License](#license)

## Installation

To install and set up the project, follow these steps:

1. **Clone the Repository**:

    ```bash
    git clone https://github.com/your-username/your-repository.git
    cd your-repository
    ```

2. **Install Dependencies**:
   Make sure you have Composer installed, then run:

    ```bash
    composer install
    ```

3. **Set Up Environment**:
   Copy the `.env.example` file to `.env` and modify it with your database and other configurations:

    ```bash
    cp .env.example .env
    ```

4. **Generate Application Key**:

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations** (if using a database):

    ```bash
    php artisan migrate
    ```

6. **Start the Server**:
    ```bash
    php artisan serve
    ```

## Usage

### 1. Using Artisan Commands

You can encode URLs directly from the command line using the Artisan command provided.

I have created two artisan commands.

1. php artisan app:encode-url {original-url}
   To shorten the original URL

2. php artisan app:decode-url {shorten-url}
   To get Original URL from shorten URL

### -----------------------------------------------------------------------

#### 2. Using APIs

To encode a URL using the Artisan command, run the following:

```bash
php artisan url:encode "https://www.thisisalongdomain.com/with/some/parameters?and=here_too"
```

-   This will output a shortened URL like `http://short.est/GeAi9K`.

### Using API via Postman

You can also interact with the service using HTTP requests. Below are the instructions to do this using Postman.

#### Encode a URL

1. Open Postman and create a new `POST` request.
2. Set the request URL to:
    ```
    http://localhost:8000/api/encode
    ```
3. Go to the `Body` tab, select `x-www-form-urlencoded`, and add the following parameter:

    - `url`: The long URL you want to shorten, e.g., `https://www.thisisalongdomain.com/with/some/parameters?and=here_too`.

4. Click `Send` to execute the request.

5. You should receive a JSON response with the shortened URL:
    ```json
    {
        "short_url": "http://short.est/GeAi9K"
    }
    ```

#### Decode a URL

1. Create a new `POST` request in Postman.
2. Set the request URL to:
    ```
    http://localhost:8000/api/decode
    ```
3. Go to the `Body` tab, select `x-www-form-urlencoded`, and add the following parameter:

    - `short_url`: The shortened URL you want to decode, e.g., `http://short.est/GeAi9K`.

4. Click `Send` to execute the request.

5. You should receive a JSON response with the original URL:
    ```json
    {
        "original_url": "https://www.thisisalongdomain.com/with/some/parameters?and=here_too"
    }
    ```

## License

This project is open-source and available under the [MIT License](LICENSE).

```

### Key Points

- **Installation**: Describes steps to set up the project environment, install dependencies, and run the server.
- **Usage**: Explains how to use the URL shortening service via both command-line and HTTP requests.
- **Testing**: Guides the user on how to run the tests to ensure the application's functionalities.
- **Postman Instructions**: Detailed steps on setting up Postman requests for both encoding and decoding URLs.
- **License**: Mentions the open-source nature of the project.

Make sure to replace the placeholder GitHub URL with the actual URL of your repository. You can also adjust the instructions if you use different environment variables or other setup procedures specific to your project.
```
