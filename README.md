## Laravel authentication test
To make this code working you have to:
1. Clone tis repo
1. Create a database
1. Copy paste the <code>.env.example</code> and rename to <code>.env</code>
1. Open the new .env file and complete with your data:
    - DB_PORT=
    - DB_DATABASE=
    - DB_USERNAME=
    - DB_PASSWORD=
<p>Usually you just have to set DB_DATABASE and DB_PASSWORD, but better checking others too.</p>

5. Open a bash console, navigate to the project directory and run the following commands in order:
    - <code>composer install</code>
    - <code>npm install && npm run dev</code>
    - <code>php artisan migrate --seed</code>
    - <code>php artisan serve</code>
1. Open your browser and go to <code>localhost:{yourPort}</code> 
#### (the "{yourPort}" field usually is 8000 but it may be different)

Register and Login are hidden to guest users
go to <code>localhost:{yourPort}/register</code> to register your account, you will be automatically redirected to the admin home.
if you already have an account go to <code>localhost:{yourPort}/login</code> to login.
