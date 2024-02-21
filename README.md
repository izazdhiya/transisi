# Laravel Project

This Laravel project serves as CRUD Data Employee and Company. It incorporates the Laravel UI Bootstrap package for authentication, Laravel Snappy for PDF generation, and Maatwebsite/Excel for handling Excel imports and exports.

## Installation

Follow these steps to set up and run the project locally:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/izazdhiya/transisi.git

2. **Install Dependencies:**
   ```bash
   composer install

3. **Copy Environment File:**
   ```bash
   cp .env.example .env

4. **Generate Aplication Key:**
   ```bash
   php artisan key:generate

5. **Configure Database:**
   - Create a new database for the project.
   - Update the .env file with your database credentials.

6. **Run Migration and Seed:**
   ```bash
   php artisan migrate && php artisan db:seed

7. **Install Node Dependencies:**
   ```bash
   npm install && npm run dev

8. **Serve The Application:**
   ```bash
   php artisan serve






