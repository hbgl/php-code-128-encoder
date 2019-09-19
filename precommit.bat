call .\vendor\bin\phpunit
call .\vendor\bin\phpstan analyse src tests --level=7
call php-cs-fixer fix .
