# Laravel API boilerplate

A Laravel template for building your next API project. 
This boilerplate offers a good starting point to build robust APIs with the latest technologies and best practices! 

Out-of-the-box includes:
- versioning system
- restful JSON
- Sanctum Authentication
- custom Artisan commands
- example endpoints
- ready for Treblle

## Requirements
* PHP 8.1+
* Laravel 9+

## Dependencies

- [composer/semver](https://github.com/composer/semver)
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)
- [laravel/framework](https://github.com/laravel/framework)
- [laravel/sanctum](https://github.com/laravel/sanctum)
- [treblle/treblle-laravel](https://github.com/treblle/treblle-laravel)

## Installation

Press the button `Use this template` at the top of this repository to create a new one with the content of this boilerplate and... happy coding 🎉.

## Getting Started

You need to get "API KEY" and "Project ID" by logging in to your Treblle account or creating a FREE one on [Treblle website](https://treblle.com/register) or by using the command line. 

```bash
php artisan treblle:start
```

when you have your "API KEY" and "Project ID", you need to add them to your `.env` file 

```bash
TREBLLE_API_KEY=YOUR_API_KEY
TREBLLE_PROJECT_ID=YOUR_PROJECT_ID
```

For more configuration options, refer to [Treblle documentation](https://github.com/Treblle/treblle-laravel#configuration-options).

## Custom Artisan Commands

Create new user
```bash
php artisan user:create
```
  
Scaffold controllers, requests, resource and tests for the given resource (remember to create Model up-front) 
```bash
php artisan treblle:make
```

## Suggestions

We suggest taking a look to these packages if you need more complex APIs:
- [Laravel Passport](https://github.com/laravel/passport)
- [Spatie Query Builder](https://github.com/spatie/laravel-query-builder)
- [Laravel Orion](https://tailflow.github.io/laravel-orion-docs/)

## Support

If you have problems of any kind feel free to reach out via <https://treblle.com> or email vedran@treblle.com, and we'll
do our best to help you out.

## License

Copyright 2021, Treblle Limited. Licensed under the MIT license:
http://www.opensource.org/licenses/mit-license.php
