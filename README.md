# toy-robot-app

## Toy Robot Coding Challenge
This is a solution to the Toy Robot Coding Challenge written in PHP.

## Setup
You will need a system running PHP 8.1 or above with composer installed.

If you have Docker, the Dockerfile provided will build a container with PHP 8.2 and composer installed for dependencies.

With Docker running, build the container with:
```
docker build -t toy-robot-app .
```

Run `composer install` to install dependencies:
```
docker run --rm -v .:/var/www/toy-robot-app -w /var/www/toy-robot-app toy-robot-app composer install
```

## Execution
The application will expect a file with a list of commands to execute.

Several test files are included in the `inputs` directory:
* `./inputs/test_place.txt`
* `./inputs/test_all_commands.txt`
* `./inputs/test_long_sequence.txt`

Simply use the following command to run the application with a test file:
```
docker run --rm -v .:/var/www/toy-robot-app -w /var/www/toy-robot-app toy-robot-app php toy-robot {{PATH TO TEST FILE}}
```

The output of the solution will be displayed in the console.

## Testing
You can also run PHPUnit to test several built-in tests for the application:

```
docker run --rm -v .:/var/www/toy-robot-app -w /var/www/toy-robot-app toy-robot-app ./vendor/phpunit/phpunit/phpunit ./tests --testdox
```
