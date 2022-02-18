<img src="https://treblle-assets.s3.amazonaws.com/laravel-api-boilerplate.png" alt="Laravel API Boilerplate" align="center">

# Laravel API boilerplate 🚀

An awesome boilerplate for your next Laravel 9 based API. It's only goal is to simply **kick-start your API development** and provide you with some of the best practices when building amazing and scalable REST APIs 🔥

## Features 🍭

### REST API Best Practices
We baked in all the best REST API practices in terms of structuring your API, naming conversations, HTTP methods, responses and optimizations
	
### Concrete examples
We all like to learn by examples and that's why  the boilerplate comes with a concrete example that include everything from folder structure, routes to naming controllers

### Scaffolding Artisan command
Tired of manually creating controllers, resources, test and form requests each time for new API endpoints. We were too. That's why we added a command that does all of that for you. Just run `php artisan treblle:make` and you get everything you need in a second</dd>

### Built-in versioning
Building a versioning system that scales is always hard and that's why we built in a robust versioning system that is easy to use and can grow with the project</dd>

### Single responsibility controllers
The boilerplate uses single responsibility controllers that make it painfully obvious what's going on and can be used with different versions

### Models, migrations and factories
We built two tables Users and Posts and defined everything you might need on a database and model level

### Sanctum authentication
Built in Laravel Sanctum authentication included in the boilerplate.

### Magical UUID trait
Want to use UUIDs but find it to much work just use our built in `InteractsWithUuid` trait and have fun with UUIDs

### Spawn a new user quickly
Easily create a new user without messing around with database clients or CRUD systems by using our custom command `php artisan user:create`

### Treblle built-in
We added an awesome Laravel package called Treblle. Out of the box Treblle gives you: real-time API monitoring, automatically generated and updated documentation, error tracking and logging, API analytics, quality scoring and much more. To get started with Treblle just run `php artisan treblle:start` and follow the instructions or visit [treblle.com](https://treblle.com) for more information


## Requirements
* PHP 8.1+
* Laravel 9+

## Dependencies

- [composer/semver](https://github.com/composer/semver)
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)
- [laravel/framework](https://github.com/laravel/framework)
- [laravel/sanctum](https://github.com/laravel/sanctum)
- [treblle/treblle-laravel](https://github.com/treblle/treblle-laravel)

## Getting started

Press the `Use this template` button at the top of this repository to create a new API with this boilerplate and 🎉.

## Thank you

The boilerplate was built by [Maurizio](https://github.com/leMaur), with some help from [cindreta](https://github.com/cindreta) and sponsored by [Treblle](https://treblle.com). We would love to have you as our contributor so please feel free to make pull requests and help us make the best API boilerplate on Github 💪🏻

## The 10 REST Commandments E-book

![# The 10 REST Commandments](https://treblle-assets.s3.amazonaws.com/api-book.jpg)Grab a free copy of The 10 REST Commandments e-book and learn how to build great REST APIs that scale in any language 👉 [https://treblle.com/ebooks/the-10-rest-commandments](https://treblle.com/ebooks/the-10-rest-commandments) 


## Support

If you have problems of any kind feel free to reach out via <https://treblle.com> or email vedran@treblle.com, and we'll
do our best to help you out.

## License

Copyright 2022, Treblle Limited. Licensed under the MIT license:
http://www.opensource.org/licenses/mit-license.php
