# CRM Tasks

This is a small conceptual test, based on [Laravel](https://laravel.com/docs/),
[Liveware](https://laravel.com/docs/10.x/blade#supercharging-blade-with-livewire)
and [Tailwind](https://tailwindcss.com/).
where users can work on "recurrent tasks".

## Features

The users can handle ***tasks groups***:
- **Create** new task groups.

The users can handle ***tasks*** (CRUD):
- **Create** new task and assign a group and periodicity to start
(each task is assigned to the users in recurrent periods).
Assign an expiration date.
- **Read**. Lists the task based on "periods of time":
TASKS TODAY, TASKS TOMORROW, etc.
- **Update**. Change the task group.

*The "users" can create "tasks" and "groups of tasks"*.

Each task can be mark as *completed* by the assigned user
and have a time to be completed (*timelimit*).

You can see the [complete documentation here](./docs/docs.md).
## License

This is an open-sourced software licensed under the
[MIT license](https://opensource.org/licenses/MIT).
