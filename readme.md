# Kris Kringle App

## Installation
### Basic Laravel Installation
Using terminal/cmd follow the steps below:
*   Git Clone https://github.com/jiwom/kris-kringle.git
*   Inside the project folder, run composer install
*   Create .env file
*   Run php artisan key:generate

### Adding user data
You can change the user from the users.json file:
*   Connect your DB from .env file
*   Run php artisan migrate
*   Go to the url /reset-seed

### Accessing the site
Go to kris-kringle/{cluster} Ex. of cluster is ob from the users.json
