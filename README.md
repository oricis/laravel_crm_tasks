# CRM Tasks

This is a small conceptual test, based on [Laravel](https://laravel.com/docs/),
[Liveware](https://laravel.com/docs/10.x/blade#supercharging-blade-with-livewire)
and [Tailwind](https://tailwindcss.com/).
where users can work on "recurrent tasks".

## Features

#### 1. The users can ***create tasks groups***

*Every task will be assigned to one task group.*

#### 2. The users ***can create tasks***, this action is composed by:
 - Fill the text fields
 - Assign a task group
 - Set the period of time where it will be active (between `start_at` and
`expired_at` datetimes)
 - Choose the times where recurrently the recurrent task will be assign to users
 - Choose the time limit where the task must be complete
(based on time periods: one hour, one day, etc.)

#### 3. The users can read their tasks.

Each user can list their assigned tasks based on "expiration times":
"TASKS TODAY", "TASKS TOMORROW", etc.

#### 4. Mark the tasks as completed

Each task can be mark as *completed* by the assigned user
and have a time to be completed (*timelimit*).

#### 5. Authentication system
The authentication system is provided by
[Jetstream](https://jetstream.laravel.com/)
with [Livewire stack](https://jetstream.laravel.com/stacks/livewire.html).


***

## How to install

You need to have a [LAMP environment](https://github.com/oricis/notes/blob/master/contents/lamp/lamp-settings.md)
with PHP 8.1 or superior installed and one modern MariaDb / MySql version
for the database.

Your system must have the usual things to
[run a Laravel installation](https://laravel.com/docs/10.x/installation)
and [Composer](https://getcomposer.org/) installed.
Also you need new versions of node and npm.

### Installation steps

1. Clone the repo (Git necessary):

    git clone https://github.com/oricis/laravel_crm_tasks.git

2. Install dependencies.

    composer install

3. Compile assets:

    npm run build
    npm run dev

4. Create a database and set the access data on the .env file

5. Generate a key:

    php artisan key:generate

6. Run migrations a seeders:

    php artisan migrate --seed

*If you run the migrations and seeders on non production environment, you have:*

 *- some "user tasks"*

 *- The users "foo@mail.com" and "baz@mail.com" with pw: "123456"*

To test you can use the laravel in-build server, run:

    php artisan serve

And open the URL.


This project has been developer under this stack:
 - Apache/2.4.57 (Ubuntu)
 - Laravel 10.48.2
 - Mysql 8.0
 - NPM 10.0.5
 - Node 20.11.1
 - PHP 8.3.4
 - Ubuntu 20.04

Some resources has been loaded from remote sources (Tailwind and Flowbite)
then you require an active Internet connection to run the app.


***

## Tests

The features was implemented using services and actions.
They all have unitary tests.

*The installed authentication package also include "feature tests".*

***Run all tests*** with [Artisan CLI](https://laravel.com/docs/10.x/artisan):

    php artisan test


***

Complete documentation ***[here](./docs/docs.md)***.

## License

This is an open-sourced software licensed under the
[MIT license](https://opensource.org/licenses/MIT).
