# Grocery Shopping List Application

A web application developed using **Laravel 13, PHP 8.5, and MySQL/MariaDB** as part of the Mayden Developer Recruitment Coding Challenge.

The application allows users to create and manage grocery shopping lists, track purchased items, calculate costs, manage budgets, and share shopping lists by email.

## Features

- **User Authentication:** Secure user registration, login, and logout.
- **Shopping List Management:** Create and manage personal shopping lists.
- **Grocery Items:** Add items with names, quantities, and unit prices.
- **Duplicate Prevention:** Prevent duplicate grocery item names within the same shopping list.
- **Purchase Tracking:** Mark grocery items as purchased or pending.
- **Delete Items:** Remove grocery items from shopping lists.
- **Drag-and-Drop Reordering:** Rearrange grocery items with persistent database ordering.
- **Price Calculation:** Calculate individual item totals and the shopping list grand total.
- **Budget Management:** Set an optional budget and receive a warning when the total exceeds it.
- **Email Sharing:** Share shopping list details by email using Laravel Mail.

## Technology Stack

| Technology | Purpose |
|---|---|
| PHP 8.5 | Backend programming language |
| Laravel 13 | Application framework |
| MySQL / MariaDB | Relational database |
| Blade | Server-side templates |
| HTML, CSS, JavaScript | Frontend |
| XAMPP | Local development environment |
| Mailtrap | Email testing |
| Git & GitHub | Version control |

## Application Architecture

The application uses Laravel's MVC architecture with additional service and repository layers to separate responsibilities.

**Controller → Service → Repository Contract → Eloquent Repository → Database**

- **Controllers:** Handle incoming HTTP requests, responses, and authorization.
- **Form Requests:** Validate user input.
- **Services:** Handle application business logic.
- **Repository Contracts:** Define interfaces for database operations.
- **Eloquent Repositories:** Implement database access using Laravel Eloquent.
- **Models:** Represent database entities and relationships.
- **Blade Views:** Render the user interface.

Repository contracts are connected to their implementations through Laravel's service container.

## Project Structure

```text
mayden-assessment/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # HTTP request handling
│   │   └── Requests/          # Form validation
│   ├── Models/                # Eloquent models
│   ├── Services/              # Business logic
│   ├── Repositories/          # Repository interfaces and implementations
│   └── Mail/                  # Email functionality
├── database/
│   └── migrations/            # Database schema
├── resources/
│   └── views/                 # Blade templates
├── public/
│   └── assets/
│       ├── css/               # Application styles
│       └── js/                # Frontend JavaScript
├── routes/
│   └── web.php                # Web application routes
├── .env.example               # Example environment configuration
├── composer.json              # PHP dependencies
└── README.md
```

## Installation and Setup

### Prerequisites

- PHP 8.5
- Composer
- MySQL or MariaDB
- Required PHP extensions
- Git

**Development Environment:** The application was developed locally on Windows using XAMPP. XAMPP is optional; any compatible PHP and database environment can be used.

### 1. Clone the Repository

```bash
git clone https://github.com/usman-yousuf/mayden-assessment.git
cd mayden-assessment
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the example environment file:

```bash
cp .env.example .env
```

For Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure Database

If using XAMPP, start the database server from the XAMPP Control Panel.

Create a new database named `mayden_assessment` using phpMyAdmin or your preferred database client.

Update the `.env` file:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mayden_assessment
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the credentials according to your local database configuration.

Laravel's `mysql` database connection supports compatible MySQL and MariaDB installations.

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Start the Application

```bash
php artisan serve
```

Open the application in your browser:

http://127.0.0.1:8000

Register an account to begin creating and managing shopping lists.

## Email Configuration

The application uses Laravel Mail to share shopping lists by email.

Mailtrap was used during development to test email functionality.

Configure SMTP settings in `.env`:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=your_mailtrap_host
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="Grocery Shopping List"
```

Replace the placeholder values with the SMTP credentials provided by Mailtrap or another email service.

Mailtrap Email Testing captures outgoing messages in a test inbox rather than delivering them to real recipients.

**Note:** The `.env` file contains sensitive credentials and must not be committed to GitHub.

## Security

The application includes:

- Authentication-protected routes.
- Ownership checks to prevent users from accessing another user's shopping lists.
- Server-side validation using Laravel Form Requests.
- CSRF protection for form submissions.
- Eloquent ORM for database interactions.
- UUID-based identifiers for shopping lists and grocery items.

## Accessibility

Basic accessibility improvements include semantic HTML, labelled form inputs, keyboard-accessible navigation and buttons, visible focus indicators, a skip-to-content link, and descriptive action labels.

Drag-and-drop reordering is currently mouse-based.

## Future Improvements

- Keyboard-accessible grocery item reordering.
- Additional automated feature tests.
- Editing existing grocery items and budget limits.
- Real-time collaborative shopping lists.
- Further responsive design and accessibility improvements.