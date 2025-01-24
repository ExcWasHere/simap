<h1 align="center">Bea Cukai Blitar - Login System</h1>

A secure authentication system built with Laravel 11, featuring a modern UI with Tailwind CSS and smooth animations powered by GSAP.

## Features

-   🔐 Secure authentication with NIP (Employee ID Number)
-   🎨 Modern UI with Tailwind CSS
-   ✨ Smooth animations using GSAP
-   🔄 Image carousel on login page
-   📱 Fully responsive design
-   ⚡ Rate limiting for login attempts
-   🔍 Comprehensive error logging

## Tech Stack

-   **Framework:** Laravel 11
-   **Styling:** Tailwind CSS v4
-   **Animations:** GSAP 3.12
-   **Database:** MySQL
-   **PHP Version:** 8.2+
-   **Build Tool:** Vite
-   **HTTP Client:** Axios

## Prerequisites

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL

## Installation

1. **Clone the repository:**

    ```bash
    git clone [<repository-url>](https://github.com/ExcWasHere/Project01.git)
    cd [<project-folder>](Project01)
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies:**

    ```bash
    npm install
    ```

4. **Create and configure the environment file:**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Configure your database in `.env`:**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

6. **Run migrations and seed the database:**

    ```bash
    php artisan migrate --seed
    ```

7. **Create storage link:**

    ```bash
    php artisan storage:link
    ```

8. **Build assets:**

    ```bash
    npm run build
    ```

## Development

-   **Run the development server:**

    ```bash
    php artisan serve
    ```

-   **Also run this on another terminal and watch for asset changes:**

    ```bash
    npm run dev
    ```

## Default Login Credentials

| Field    | Value           |
| -------- | --------------- |
| NIP      | 1234567890      |
| Email    | admin@gmail.com |
| Password | password        |

## Note
If you have already migrated the database and want to reseed it, use this command:
    ```bash
    php artisan migrate:refresh seed
    ```

## Contributing

We welcome contributions! Here's how you can contribute:

1. **Fork the repository**
2. **Create your feature branch:**

    ```bash
    git checkout -b feature/amazing-feature
    ```

3. **Commit your changes:**

    ```bash
    git commit -m 'Add some amazing feature'
    ```

4. **Push to the branch:**

    ```bash
    git push origin feature/amazing-feature
    ```

5. **Open a Pull Request**

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgments

We extend our gratitude to the following:

-   The Laravel Team
-   The Tailwind CSS Team
-   The GSAP Team
-   Direktorat Jenderal Bea dan Cukai