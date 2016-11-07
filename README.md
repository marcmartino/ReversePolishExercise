* install dependencies using composer from directory root
    * `composer install`
* run unit tests from directory root using
    * `phpunit --bootstrap vendor/autoload.php tests/`
* run webserver from directory root using
    * `php -S localhost:8000 routing.php`
* send get requests to
    * `http://localhost:8000/calculate?exp="url encoded expression"`
    * for example `http://localhost:8000/calculate?exp=5%201%202%20%2B%204%20*%20%2B%203%20-`is the string for `5 1 2 + 4 * + 3 -`