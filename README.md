Demo shopping cart project using Vue and Laravel

To run the backend

`cd backend`
`composer install`
`npm install`

create empty database file
(manually or via `touch database/database.sqlite` )


`php artisan migrate`
`php artisan db:seed`

`php artisan serve`

To run the frontend

`cd frontend`
`npm install`
`npm run dev`

create .env file like the example (point to location where backend is running)

Default user already availabe is `test@example.com` with password being `password`