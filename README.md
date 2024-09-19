# Chatbot Builder

## Description

> **A user-friendly interface for organizing and managing chatbot prompts efficiently.**

1. Remove duplication of prompts by introducing prompt blocks and block references/ organization
2. Drag and drop UI allow us to create bot by selecting prompt building blocks and make a prompt for a chat bot.

## Features

**Main features**:

- Simple and intuitive UI
- Search functionality
- Categorization of prompts

*Future features* includes

- Forking / Versioning / Diff Comparison
- Direct Import Bot from full prompt Text
- Grouping
- Templating
- Better UI interaction (such as save while editing)

## Dependencies

1. PHP
2. Composer
3. PostgreSQL

## Installation

1. Clone the repository:

    ```bash
    git clone <>
    ```

2. Navigate to the project directory:

    ```bash
    cd chatbot-builder
    ```

3. Install dependencies:

    ```bash
    npm install
    composer install
    ```

## Usage

Setup environment variables

```bash
cp .env.example .env
```

Make sure to have the db connection in the `.env`

```text
DB_CONNECTION=pgsql
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=password
```

To start the application:

1. Create the database

    ```bash
    php artisan db:migrate
    ```

2. Generate stylesheet first

    ```bash
    npm run build
    ```

3. Start the web server

    ```bash
    artisan serve
    ```

Open your browser and navigate to `http://127.0.0.1:8000`.

## Contributing

🤷‍♂️

## License

🤷‍♂️
