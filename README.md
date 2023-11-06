# toy-robot-app

## Toy Robot Coding Challenge
This is a solution to the Toy Robot Coding Challenge written in PHP.

## Setup
You will need a system running PHP 8.1 or above.

An easy way to run the solution is to set up a GitHub Codespace using the provided devcontainer.json file.

Simply start by creating a codespace on master:

<img width="297" alt="image" src="https://github.com/julian-smithies/toy-robot-app/assets/27047577/e7225df0-3277-4908-8837-f69f2da9da68">


Once the codespace is up and the terminal is ready, run the PHP CLI built-in test server:

```
php -S localhost:8000 ./router.php
```

Navigate to the ports tab to preview the app in your browser.

## Execution
By default, the application will route to `public/index.php`. This script is set up to load commands from a test file in the `inputs` folder.

The default test file is `test_all_commands.txt`. Two other test files are also provided: `test_place.txt` and `test_long_sequence.txt`. You can modify the `public/index.php` to test these (or any other) command files as needed.

The output of the solution will be displayed in the browser preview.

## Testing
You can also run PHPUnit to test the application (does not require the PHP CLI server to be running). First, run composer install if PHPUnit is not already installed:

```
composer install
```

Then, run PHPUnit using the `./tests` directory:

```
./vendor/phpunit/phpunit/phpunit ./tests --testdox
```
