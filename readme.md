# Kris Kringle App

##Installation
###Basic Laravel Installation
*   Git Clone https://github.com/jiwom/kris-kringle.git
*   Go to the project folder and execute composer install using your terminal
*   Create .env file
*   Execute php artisan key:generate

###Adding user data
you can change the user from the users.json file
*   Connect your DB from .env file
*   php artisan migrate
*   go to the url /reset-seed

###Accessing the site
Go to kris-kringle/{cluster} Ex. of cluster is ob from the users.json
