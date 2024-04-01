# Newsletter App 

# Laravel

Welcome to my web page project, where I've used Laravel backend and Next.js frontend to create a newsletter app with email notifications. You can get laravel app code in this link [Next.js-Github](https://github.com/Sumeyye-Mete/Newsletter-Frontend.git). 

In this project users can  explore a list of news items and view details of each item. Cached data is marked as green frame for news items. Admin user can login and do CRUD operations for news items. Subcribed users can get email notifications when a new news item is published. A summary of all news items added that day is sent as email to subscribed users.

## Project Video Demo:

https://github.com/Sumeyye-Mete/Newsletter-Backend/assets/143296901/01a9a727-eae5-412e-9b4c-452ced24d8d7


## Setting Project 

1-install the dependencies:

```bash
composer create-project
```

2- migrate and seed:

```bash
php artisan migrate --seed
```
3- run the local server:

```bash
php artisan serve
```
4- open a new terminal and start the schedular:

```bash
php artisan schedule:work 
```

Set the next.js [project](https://github.com/Sumeyye-Mete/Newsletter-Frontend.git). Your local backend server should work on [http://localhost:8000](http://localhost:8000) and next.js app should work on [http://localhost:3000](http://localhost:3000) 
