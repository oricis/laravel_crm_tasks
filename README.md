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

***

Complete documentation ***[here](./docs/docs.md)***.

## License

This is an open-sourced software licensed under the
[MIT license](https://opensource.org/licenses/MIT).
