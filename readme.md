# Laravel 5.6 + CoreUI Admin Bootstrap + VueJS + JWT


## What is this?

This is a boilerplate for a SPA Admin application with Laravel 5.6, VueJS, CoreUI and JWT authentication (hope it can save up some time for someone who's developing a project like that).
It's using following open sources:
- [laravel-coreui-vue](https://github.com/Braunson/laravel-coreui-vue)
- [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)
- [websanova/vue-auth](https://github.com/websanova/vue-auth)
- [laravel-permission](https://github.com/spatie/laravel-permission)
- [laravel-fractal](https://github.com/spatie/laravel-fractal). I really like the [Fractal](https://fractal.thephpleague.com) library after reading the book [Build APIs You Won't Hate](https://leanpub.com/build-apis-you-wont-hate)


## What have been implemented:

- integrated Laravel 5.6 with [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth). There are some small problems when integrate with this library, so I have to use the branch 'develop'.
- integrated [websanova/vue-auth](https://github.com/websanova/vue-auth) with the current [laravel-coreui-vue](https://github.com/Braunson/laravel-coreui-vue), now it can authenticate users from Laravel backend, and authorize on each Vue routes.
- upgraded BootstrapVue to the latest version, fixed some issues during migration.
- integrated [laravel-permission](https://github.com/spatie/laravel-permission) to manage roles & permissions in the backend.
- integrated [vuex](https://vuex.vuejs.org/). Oh, I like the idea of Flux!
- created some simple APIs in the backend to get test data (Users, Articles).
- created some simple pages in the frontend to display test data. That is to demonstrate how to use vue-auth.
- updated the SideBar.vue & nav.js to display each menu item based on user' roles.


## Getting Started

```
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate:refresh --seed
npm install
npm run dev
php artisan serve

```
### Data for testing:

- admin@test.com / 123456
- moderator@test.com / 123456
- user@test.com / 123456


## License

The MIT License (MIT)
