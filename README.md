# JWT-login-register-example-
JWT login/register example
Requirements: postman

Usage
Laravel:
1) php artisan serve
2) php artisan migrate
3) php artisan tinker
4) factory('App\User', 6)->create();

Postman
1) open postman
2) select post
3) localhost:8000/api/register
4) select body with 3 parameters: name,password,email
4) localhost:8000/api/authenticate
5) Pick email and enter it along with the password (no need for name)
6) Receive token :D
