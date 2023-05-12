call .\vendor\bin\php-cs-fixer fix .
call .\vendor\bin\phpunit
call .\vendor\bin\phpstan analyse src tests --level=8
