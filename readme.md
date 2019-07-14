# TravelFast
An example Laravel app

# How to set it up?
1. Clone this repository
2. Run these commands:
    ```sh
    $ composer install
    $ npm install
    ```
3. Generate key:
    ```sh
    $ php artisan key:generate
    ```
4. Migrate:
    ```sh
    $ php artisan migrate
    ```
5. *(Optional)* You may also seed database!
    ```sh
    $ php artisan db:seed
    ```
6. Compile assets
    ```sh
    $ npm run production
    ```
7. Now you should be able to run:
    ```sh
    $ php artisan serve
    ```
    
