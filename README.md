<h1 align="center">Laravel Vue Admin Panel</h1>
<h3 align="center">A Single page Vue admin panel for Laravel projects.</h3>
<p align="center">
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/balajidharma/laravel-vue-admin-panel"><img src="https://poser.pugx.org/balajidharma/laravel-vue-admin-panel/license" alt="License"></a>
</p>

## Built with
- [Laravel 11](https://github.com/laravel/framework)
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- [Laravel Breeze](https://github.com/laravel/breeze)
- [Vue 3](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Inertiajs](https://inertiajs.com/)
- [Admin One - Admin Dashboard](https://github.com/justboil/admin-one-vue-tailwind)

## Installation


- To get started, you need to install [PHP Composer](https://getcomposer.org/).

- `cd admin-app`
- Create a new MYSQL database and update database details in `.env` file
- `php artisan vendor:publish --tag=admin-core`
- `php artisan migrate --seed --seeder=AdminCoreSeeder`
- `npm install`
- `npm run dev`
- `php artisan serve`
- Now open http://localhost:8000/

###### Super Admin Login
- Email - superadmin@example.com
- Password - password

#### Admin Configuration:

To change the Admin Prefix, change `prefix` on `config/admin.php` or add the `ADMIN_PREFIX` on env 

```php
'prefix' => env('ADMIN_PREFIX', 'admin'),
```


## Screenshots
<p align="center">
	<img src="https://res.cloudinary.com/darym3wju/image/upload/v1720884451/xxuit39dixret9qfqmny.png" >
	<br/><br/>
	<img src="https://res.cloudinary.com/darym3wju/image/upload/v1720884451/ndnceg9h4ho7toknscrn.png" >
	<br/><br/>
	<img src="https://res.cloudinary.com/darym3wju/image/upload/v1720884450/fk8uibu3r9zdz0qs4khl.png" >
    <br/><br/>
	<img src="https://res.cloudinary.com/darym3wju/image/upload/v1720884450/w5fqhji5jch3a6pa5mhq.png">
	<br/><br/>
	<img src="https://res.cloudinary.com/darym3wju/image/upload/v1720884451/cgqmb1fzjgwjlwrl0du4.png">
	<br/><br/>
	<img src="https://res.cloudinary.com/darym3wju/image/upload/v1720884451/id03xxbnvwogvqj5rhgt.png">
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
