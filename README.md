Step 1: Install Required Software
Make sure you have the following installed on your computer:
PHP (for Laravel projects)
Composer (PHP package manager)
Node.js & npm (for front-end assets)
MySQL (or another database)
Git (for version control)

Step 2: Clone the Project
Open your terminal and run:
git clone https://github.com/Tejaswini-P-M/task-manager.git
cd task-manager

Step 3: Install Dependencies
Run these commands to install the project dependencies:
composer install      # PHP dependencies
npm install           # Front-end dependencies

Step 4: Configure Environment
Copy the .env.example file to .env:
cp .env.example .env
Open .env and set your database credentials:
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=your_password

Step 5: Generate Application Key
Run the Laravel command:
php artisan key:generate

Step 6: Run Database Migrations
Create the required tables in your database:
php artisan migrate

Step 7: Run the Development Server
Start the local server:
php artisan serve
