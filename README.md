# Birdboard - Test Driven Development with Laracast
This project is a code along tutorial building test driven development application with Laracast using Laravel homestead, vagrant box, php and SQL Workbench on Windows 10. 

## Getting Started
Setting up MySQL Workbench

Git bash to `/Homestead
```
$ vagrant ssh-config
```
The ```SSH Username```, ```SSH Key file```, ```MySQL Hostname``` and ```MySQL Server Port``` will be listed. Note that if the default ```MySQL Server Port``` 2222 does not work, use 3306 instead.

Then connect to Vagrant VM
 ```
 $ vagrant ssh
 ```
Type the following command and the SSH Hostname will be listed at eth1
```
$ ip a
```  

Now that the connection to MySQL is successful, Open the project and configure the .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=birdboard
DB_USERNAME=root
```
Set the database connection to be used in memory instead for TDD instead of MySQL. Open phpunit.xml and add the following:
``` xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

## My notes
### Make a new test
```
php artisan make:test <test name>
```
### Run a test
```
vendor/bin/phpinit <path to test file>
```

### Run all tests
```
vendor/bin/phpunit
```

### Run a test by test name
```
vendor/bin/phpunit --filter <test name>
```

### Aliases - with example
```
alias <alias>="<alias name>"

alias pf="vendor/bin/phpunit --filter"
```
### Using the alias
```
pf <test name>
```
### To use a fresh database before running each test, use RefreshDatabase when declaring a new test object
```php
class Test extends TestCase 
{
  use RefreshDatabase;
  ...
  ...
}
```

### Factory create, make and raw
```php
Project::factory()->create(); // Will build up a project and save it to the database
Project::factory()->make(); // Will build up a project without saving it to the database
Project::factory()->raw(); // will build uo a project, store it as an array without saving it to the database
```
